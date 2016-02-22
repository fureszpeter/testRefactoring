<?php
namespace Language\Infrastructure\Services;

use Language\Domain\Contracts\WriteService;
use Language\Domain\Entities\Applet;
use Language\Domain\Entities\Application;
use Language\Domain\ValueObjects\Translation;
use Language\Infrastructure\Contracts\PathGenerator;
use RuntimeException;

/**
 * Class WriteServiceV1.
 *
 * @package Language
 *
 * @license Proprietary
 */
class WriteServiceV1 implements WriteService
{
    /**
     * @var \Language\Infrastructure\Contracts\PathGenerator
     */
    private $pathGenerator;

    /**
     * @param \Language\Infrastructure\Contracts\PathGenerator $pathGenerator
     */
    public function __construct(PathGenerator $pathGenerator)
    {
        $this->pathGenerator = $pathGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function writeTranslations(Application $application, Translation ...$translations)
    {
        $path = $this->pathGenerator->generateLanguageCachePath($application);

        $this->ensurePathExists($path);

        foreach ($translations as $translation) {
            $result = file_put_contents(
                $this->pathGenerator->generateLanguageFilePath(
                    $application,
                    $translation->getLanguage()
                ),
                $translation->getContent()
            );

            if (! $result) {
                throw new RuntimeException(
                    sprintf(
                        'Unable to write translation. Translation: %s. Error: Unable to create file.',
                        $translation->getLanguage()
                    )
                );
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function writeAppletTranslations(Applet $applet, Translation ...$translations)
    {
        $firstPath = $this->pathGenerator->generateXmlFilePath(current($translations)->getLanguage());
        $this->ensurePathExists(dirname($firstPath));

        $files = [];
        foreach ($translations as $translation) {
            $filePath = $this->pathGenerator->generateXmlFilePath($translation->getLanguage());
            $files[] = $filePath;

            $result = file_put_contents(
                $filePath,
                $translation->getContent()
            );

            if (! $result) {
                throw new RuntimeException(
                    sprintf(
                        'Unable to write translation. Translation: %s. Error: Unable to create file.',
                        $translation->getLanguage()
                    )
                );
            }
        }

        return $files;
    }

    /**
     * @param string $path
     *
     * @throws \RuntimeException If path not exists and unable to create it.
     *
     * @return void
     */
    private function ensurePathExists($path)
    {
        if (is_dir($path)) {
            return;
        }

        if (! mkdir($path)) {
            throw new RuntimeException(
                sprintf('Unable to create path. Path: %s', $path)
            );
        }
    }
}
