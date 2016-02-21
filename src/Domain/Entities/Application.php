<?php
namespace Language\Domain\Entities;

use Furesz\TypeChecker\TypeChecker;
use Language\Domain\ValueObjects\Language;

/**
 * Represent an application Entity.
 *
 * @package Language
 *
 * @license Proprietary
 */
class Application
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \Language\Domain\ValueObjects\Language[]
     */
    private $languages;

    /**
     * @param string $name
     * @param \Language\Domain\ValueObjects\Language[] ...$languages
     *
     * @throws \InvalidArgumentException If name is non-string.
     * @throws \InvalidArgumentException If at least minimum one Language name is not set.
     */
    public function __construct($name, Language ...$languages)
    {
        TypeChecker::assertString($name, '$name');

        $this->name = $name;
        $this->languages = $languages;
    }

    /**
     * @param \Language\Domain\ValueObjects\Language[] ...$languages
     */
    public function setLanguages(Language ...$languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \Language\Domain\ValueObjects\Language[]
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
