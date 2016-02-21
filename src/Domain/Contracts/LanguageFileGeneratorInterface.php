<?php
namespace Language\Domain\Contracts;

/**
 * Class LanguageFileGeneratorInterface.
 *
 * @package Language
 *
 * @license Proprietary
 */
interface LanguageFileGeneratorInterface
{
    /**
     * Starts the language file generation.
     *
     * @throws \RuntimeException If unable to generate language files.
     *
     * @return void
     */
    public function generateLanguageFiles();

    /**
     * Gets the language files for the applet and puts them into the cache.
     *
     * @throws \RuntimeException If unable to generate XML files.
     *
     * @return void
     */
    public function generateAppletLanguageXmlFiles();
}
