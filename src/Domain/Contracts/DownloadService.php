<?php
namespace Language\Domain\Contracts;

use Language\Domain\Entities\Applet;
use Language\Domain\Entities\Application;

/**
 * Download translations.
 *
 * @package Language\Domain\Contracts
 */
interface DownloadService
{
    /**
     * @param \Language\Domain\Entities\Application $application
     *
     * @throws \RuntimeException If unable to download translation.
     *
     * @return \Language\Domain\ValueObjects\Translation[]
     */
    public function downloadTranslation(Application $application);

    /**
     * @param \Language\Domain\Entities\Applet $applet
     *
     * @return \Language\Domain\ValueObjects\Language[]
     */
    public function downloadAppletAvailableLanguages(Applet $applet);

    /**
     * @param \Language\Domain\Entities\Applet $applet
     *
     * @throws \RuntimeException If unable to download translation.
     *
     * @return \Language\Domain\ValueObjects\Translation[]
     */
    public function downloadAppletTranslations(Applet $applet);
}
