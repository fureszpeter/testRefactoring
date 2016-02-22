<?php
namespace Language\Infrastructure\Services;

use Language\Config;
use Language\Domain\Entities\Application;
use Language\Domain\ValueObjects\Language;
use Language\Infrastructure\Contracts\PathGenerator as PathGeneratorInterface;

/**
 * Class PathGenerator.
 *
 * @package Language
 *
 * @license Proprietary
 */
class PathGenerator implements PathGeneratorInterface
{
    /**
     * @param \Language\Domain\Entities\Application $application
     *
     * @return string
     */
    public function generateLanguageCachePath(Application $application)
    {
        return sprintf(
            '%s/cache/%s',
            Config::get('system.paths.root'),
            $application
        );
    }

    /**
     * @param \Language\Domain\Entities\Application $application
     * @param \Language\Domain\ValueObjects\Language $language
     *
     * @return string
     */
    public function generateLanguageFilePath(Application $application, Language $language)
    {
        return sprintf(
            '%s/%s.php',
            $this->generateLanguageCachePath($application),
            $language->getLanguageCode()
        );
    }

    /**
     * @param \Language\Domain\ValueObjects\Language $language
     *
     * @return string
     */
    public function generateXmlFilePath(Language $language)
    {
        return sprintf(
            '%s/cache/flash/lang_%s.xml',
            Config::get('system.paths.root'),
            $language->getLanguageCode()
        );
    }
}
