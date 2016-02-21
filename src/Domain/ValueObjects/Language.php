<?php
namespace Language\Domain\ValueObjects;

use Furesz\TypeChecker\TypeChecker;
use JsonSerializable;

/**
 * Represent a valid allowed language.
 *
 * @package Language
 *
 * @license Proprietary
 */
class Language implements JsonSerializable
{
    const ALLOWED_LANGUAGES = [
        'hu' => 'hungarian',
        'en' => 'english',
    ];

    /**
     * @var string
     */
    private $languageCode;

    /**
     * @var string
     */
    private $languageName;

    /**
     * @param string $languageCode
     */
    public function __construct($languageCode)
    {
        $this->setLanguageCode($languageCode);
    }

    /**
     * @param string $languageCode
     *
     * @throws \InvalidArgumentException If argument is not a string.
     * @throws \UnexpectedValueException If argument is not a valid language code.
     *
     * @return $this
     */
    private function setLanguageCode($languageCode)
    {
        TypeChecker::assertString($languageCode, '$languageCode');

        if (! array_key_exists($languageCode, self::ALLOWED_LANGUAGES)) {
            throw new \UnexpectedValueException();
        }

        $this->languageCode = $languageCode;
        $this->languageName = self::ALLOWED_LANGUAGES[$languageCode];

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * @return string
     */
    public function getLanguageName()
    {
        return $this->languageName;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->languageName;
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->languageCode,
            'name' => $this->languageName,
        ];
    }
}
