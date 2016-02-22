<?php
namespace Language\Infrastructure\Services;

use Language\Domain\Contracts\ApiClient;
use Language\Domain\Contracts\DownloadService;
use Language\Domain\Entities\Applet;
use Language\Domain\Entities\Application;
use Language\Domain\ValueObjects\Translation;

/**
 * DownloadService implementation.
 *
 * @package Language
 *
 * @license Proprietary
 */
class ApiDownloadService implements DownloadService
{
    /**
     * @var \Language\Domain\Contracts\ApiClient
     */
    private $apiClient;

    /**
     * @param \Language\Domain\Contracts\ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * {@inheritdoc}
     */
    public function downloadTranslation(Application $application)
    {
        $translations = [];

        foreach ($application->getLanguages() as $language) {
            $translations[] = new Translation(
                $language,
                $this->apiClient->getLanguageFileContent($language)
            );
        }

        return $translations;
    }

    /**
     * {@inheritdoc}
     */
    public function downloadAppletTranslations(Applet $applet)
    {
        $translations = [];

        foreach ($applet->getLanguages() as $language) {
            $translations[] = new Translation(
                $language,
                $this->apiClient->getAppletLanguageFileContent($applet, $language)
            );
        }

        return $translations;
    }

    /**
     * @param \Language\Domain\Entities\Applet $applet
     *
     * @return \Language\Domain\ValueObjects\Language[]
     */
    public function downloadAppletAvailableLanguages(Applet $applet)
    {
        return $this->apiClient->getAppletLanguages($applet);
    }
}
