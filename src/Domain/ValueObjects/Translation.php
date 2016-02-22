<?php
namespace Language\Domain\ValueObjects;

use Furesz\TypeChecker\TypeChecker;

/**
 * Represent a translation.
 *
 * @package Language
 *
 * @license Proprietary
 */
class Translation
{
    /**
     * @var \Language\Domain\ValueObjects\Language
     */
    private $language;

    /**
     * @var string
     */
    private $content;

    /**
     * Translation constructor.
     *
     * @param \Language\Domain\ValueObjects\Language $language
     * @param string $content
     */
    public function __construct(Language $language, $content)
    {
        $this
            ->setLanguage($language)
            ->setContent($content);
    }

    /**
     * @param \Language\Domain\ValueObjects\Language $language
     *
     * @return $this
     */
    private function setLanguage(Language $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param string $content
     *
     * @throws \InvalidArgumentException If RAW content is not string.
     * @throws \UnexpectedValueException If content is empty.
     *
     * @return $this
     */
    private function setContent($content)
    {
        TypeChecker::assertString($content, '$content');

        if (trim($content) === '') {
            throw new \UnexpectedValueException('Empty translation content not allowed!');
        }

        $this->content = $content;

        return $this;
    }

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getContent();
    }
}
