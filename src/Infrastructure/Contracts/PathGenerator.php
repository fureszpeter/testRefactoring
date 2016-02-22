<?php
namespace Language\Infrastructure\Contracts;

use Language\Domain\Entities\Application;
use Language\Domain\ValueObjects\Language;

/**
 * Interface PathGenerator.
 *
 * @package Language
 *
 * @license MIT
 */
interface PathGenerator
{
    /**
     * @param \Language\Domain\Entities\Application $application
     *
     * @return string
     */
    public function generateLanguageCachePath(Application $application);

    /**
     * @param \Language\Domain\Entities\Application $application
     * @param \Language\Domain\ValueObjects\Language $language
     *
     * @return mixed
     */
    public function generateLanguageFilePath(Application $application, Language $language);
    /**
     * @param \Language\Domain\ValueObjects\Language $language
     *
     * @return string
     */
    public function generateXmlFilePath(Language $language);
}
