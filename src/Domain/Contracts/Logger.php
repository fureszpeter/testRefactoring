<?php
namespace Language\Domain\Contracts;

/**
 * Log a message to a destination.
 *
 * @package Language
 *
 * @license MIT
 */
interface Logger
{
    /**
     * @param string $message
     *
     * @throws \InvalidArgumentException If message is not a string.
     *
     * @return void
     */
    public function log($message);
}
