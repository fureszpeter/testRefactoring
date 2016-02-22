<?php
namespace Language\Domain\Factories;

use Language\Infrastructure\Services\PathGenerator;

/**
 * Class PathGeneratorFactory.
 *
 * @package Language
 *
 * @license Proprietary
 */
class PathGeneratorFactory
{
    /**
     * @return \Language\Infrastructure\Services\PathGenerator
     */
    public static function create()
    {
        return new PathGenerator();
    }
}
