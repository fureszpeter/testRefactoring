<?php
namespace Language\Domain\Contracts;

use Language\Domain\Entities\Applet;
use Language\Domain\Entities\Application;
use Language\Domain\ValueObjects\Translation;

/**
 * Write Translations.
 *
 * @package Language
 *
 * @license MIT
 */
interface WriteService
{
    /**
     * @param \Language\Domain\ValueObjects\Translation[] ...$translations
     * @param \Language\Domain\Entities\Application $application
     *
     * @throws \RuntimeException If unable to write translations
     *
     * @return void
     */
    public function writeTranslations(Application $application, Translation ...$translations);

    /**
     * @param \Language\Domain\Entities\Applet $applet
     * @param \Language\Domain\ValueObjects\Translation[] ...$translations
     *
     * @throws \RuntimeException If unable to write translations
     *
     * @return string[] Array of file paths.
     */
    public function writeAppletTranslations(Applet $applet, Translation ...$translations);
}
