<?php
namespace Language\Domain\Factories;

use Language\Infrastructure\Services\ConsoleLogger;

/**
 * Class LoggerFactory.
 *
 * @package Language
 *
 * @license Proprietary
 */
class LoggerFactory
{
    /**
     * @return \Language\Infrastructure\Services\ConsoleLogger
     */
    public static function create()
    {
        return new ConsoleLogger();
    }
}
