<?php
namespace Language\Infrastructure\Services;

use Language\Config;
use Language\Domain\Contracts\LanguageFileGeneratorInterface;
use Language\Domain\Contracts\Logger;
use Language\Domain\Factories\ApplicationFactory;

/**
 * Bash implementation of LanguageFileGeneratorInterface.
 *
 * @package Language
 *
 * @license Proprietary
 */
class BashLanguageFileGenerator implements LanguageFileGeneratorInterface
{
    /**
     * @var \Language\Domain\Contracts\Logger
     */
    private $logger;

    /**
     * @param \Language\Domain\Contracts\Logger $logger
     */
    public function __construct(Logger $logger = null)
    {
        $this->logger = $logger ?: new ConsoleLogger();
    }

    /**
     * {@inheritdoc}
     */
    public function generateLanguageFiles()
    {
        $applications = ApplicationFactory::createFromArray(Config::get('system.translated_applications'));

        $this->logger->log('Generating language files');

        foreach ($applications as $application) {
            $this->logger->log(sprintf('Application: %s', $application));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function generateAppletLanguageXmlFiles()
    {
        // TODO: Implement generateAppletLanguageXmlFiles() method.
    }
}
