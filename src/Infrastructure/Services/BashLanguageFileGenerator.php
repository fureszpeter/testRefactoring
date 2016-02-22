<?php
namespace Language\Infrastructure\Services;

use Language\Config;
use Language\Domain\Contracts\DownloadService;
use Language\Domain\Contracts\LanguageFileGeneratorInterface;
use Language\Domain\Contracts\Logger;
use Language\Domain\Contracts\WriteService;
use Language\Domain\Entities\Applet;
use Language\Domain\Factories\ApplicationFactory;
use Language\Domain\ValueObjects\Translation;
use RuntimeException;

/**
 * Bash implementation of LanguageFileGeneratorInterface.
 *
 * @package Language
 *
 * @license Proprietary
 */
class BashLanguageFileGenerator implements LanguageFileGeneratorInterface
{
    /**
     * @var \Language\Domain\Contracts\Logger
     */
    private $logger;

    /**
     * @var \Language\Domain\Contracts\DownloadService
     */
    private $downloadService;

    /**
     * @var \Language\Domain\Contracts\WriteService
     */
    private $writeService;

    /**
     * @param \Language\Domain\Contracts\Logger $logger
     * @param \Language\Domain\Contracts\DownloadService $downloadService
     * @param \Language\Domain\Contracts\WriteService $writeService
     */
    public function __construct(
        Logger $logger,
        DownloadService $downloadService,
        WriteService $writeService
    ) {
        $this->logger = $logger;
        $this->downloadService = $downloadService;
        $this->writeService = $writeService;
    }

    /**
     * {@inheritdoc}
     */
    public function generateLanguageFiles()
    {
        $applications = ApplicationFactory::createFromArray(Config::get('system.translated_applications'));

        $this->logger->log('Generating language files');

        foreach ($applications as $application) {
            $this->logger->log(sprintf('Application: %s', $application));
            try {
                /*
                 * @TODO Add queue service and jobs. Don't wait for process! Re-queue if fail.
                 */
                $translations = $this->downloadService->downloadTranslation($application);

                $this->logger->log(
                    sprintf(
                        'Translations downloaded. Translations: %s',
                        implode(', ', array_map(function (Translation $translation) {
                        return $translation->getLanguage();
                    }, $translations)))
                );

                $this->writeService->writeTranslations($application, ...$translations);

                $this->logger->log(
                    sprintf(
                        'Application translations done. Application: %s. Translation: %s',
                        $application,
                        implode(', ', $application->getLanguages())
                    )
                );
            } catch (RuntimeException $e) {
                //Don't fail every app in case of one app is failing.
                $this->logger->log(
                    sprintf(
                        'Unable to write translations for application: %s. Error: %s',
                        $application,
                        $e->getMessage()
                    )
                );
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function generateAppletLanguageXmlFiles()
    {
        // List of the applets [directory => applet_id].
        $applets = [
            'memberapplet' => 'JSM2_MemberApplet',
        ];

        foreach ($applets as $appletDirectory => $appletId) {
            $this->logger->log(sprintf('Processing Applet %s', $appletId));
            $applet = new Applet($appletId, $appletDirectory);
            $languages = $this->downloadService->downloadAppletAvailableLanguages($applet);
            $this->logger->log(sprintf('Languages downloaded: %s', implode(', ', $languages)));

            $applet->setLanguages(...$languages);

            $translations = $this->downloadService->downloadAppletTranslations($applet);
            $this->logger->log(sprintf('Downloaded translations.'));
            $files = $this->writeService->writeAppletTranslations($applet, ...$translations);
            $this->logger->log(sprintf('Translation done: %s', implode(', ', $files)));
        }
    }
}
