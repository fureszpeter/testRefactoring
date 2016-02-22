<?php
namespace Language\Infrastructure\Services;

use Language\Domain\Contracts\Logger;

/**
 * Class ConsoleLogger.
 *
 * @package Language
 *
 * @license Proprietary
 */
class ConsoleLogger implements Logger
{
    /**
     * {@inheritdoc}
     */
    public function log($message)
    {
        echo sprintf("%s\n", $message);
    }
}
