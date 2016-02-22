<?php
namespace Language\Domain\Entities;

use Furesz\TypeChecker\TypeChecker;
use JsonSerializable;
use Language\Domain\ValueObjects\Language;

/**
 * Class Applet.
 *
 * @package Language
 *
 * @license Proprietary
 */
class Applet implements JsonSerializable
{
    /**
     * @var string
     */
    private $appletId;

    /**
     * @var string
     */
    private $directory;

    /**
     * @var \Language\Domain\ValueObjects\Language[]
     */
    private $languages = [];

    /**
     * Applet constructor.
     *
     * @param string $appletId
     * @param string $directory
     *
     * @throws \InvalidArgumentException If $directory is not string.
     * @throws \InvalidArgumentException If $appletId is not string.
     */
    public function __construct($appletId, $directory)
    {
        TypeChecker::assertString($appletId, '$appletId');
        TypeChecker::assertString($directory, '$directory');

        $this->directory = $directory;
        $this->appletId = $appletId;
    }

    /**
     * @return string
     */
    public function getAppletId()
    {
        return $this->appletId;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param \Language\Domain\ValueObjects\Language[] $languages
     */
    public function setLanguages(Language ...$languages)
    {
        $this->languages = $languages;
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
        return $this->getAppletId();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getAppletId(),
            'directory' => $this->getDirectory(),
            'languages' => $this->getLanguages(),
        ];
    }
}
