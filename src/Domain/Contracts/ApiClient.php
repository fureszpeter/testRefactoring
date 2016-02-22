<?php
namespace Language\Domain\Contracts;

use Language\Domain\Entities\Applet;
use Language\Domain\ValueObjects\Language;

/**
 * Language specific API calls.
 *
 * @package Language
 *
 * @license MIT
 */
interface ApiClient
{
    /**
     * @param \Language\Domain\ValueObjects\Language $language
     *
     * @throws \RuntimeException If Language file content cannot be get.
     *
     * @return string Language file RAW content.
     */
    public function getLanguageFileContent(Language $language);

    /**
     * @param \Language\Domain\Entities\Applet $applet
     *
     * @throws \RuntimeException If Language file content cannot be get.
     *
     * @return \Language\Domain\ValueObjects\Language[]
     */
    public function getAppletLanguages(Applet $applet);

    /**
     * @param \Language\Domain\Entities\Applet $applet
     * @param \Language\Domain\ValueObjects\Language $language
     *
     * @return string Language file RAW content.
     */
    public function getAppletLanguageFileContent(Applet $applet, Language $language);
}
