<?php
namespace Language\Domain\Factories;

use Language\Domain\ValueObjects\Language;

/**
 * Create Language VO from array.
 *
 * @package Language
 *
 * @license Proprietary
 */
class LanguageFactory
{
    /**
     * @param array $languageCodes
     *
     * @return \Language\Domain\ValueObjects\Language[]
     */
    public static function createFromArray(array $languageCodes)
    {
        $languages = [];
        foreach ($languageCodes as $languageCode) {
            $languages[] = new Language($languageCode);
        }

        return $languages;
    }
}
