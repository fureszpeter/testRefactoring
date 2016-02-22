<?php
namespace Language\Domain\Factories;

use Language\Infrastructure\Services\BashLanguageFileGenerator;

/**
 * Class BashLanguageFileGeneratorFactory.
 *
 * @package Language
 *
 * @license Proprietary
 */
class BashLanguageFileGeneratorFactory
{
    /**
     * @return \Language\Infrastructure\Services\BashLanguageFileGenerator
     */
    public static function create()
    {
        return new BashLanguageFileGenerator(
            LoggerFactory::create(),
            DownloadServiceFactory::create(),
            WriteServiceFactory::create()
        );
    }
}
