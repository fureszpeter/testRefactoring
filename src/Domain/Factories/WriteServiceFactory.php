<?php
namespace Language\Domain\Factories;

use Language\Infrastructure\Services\WriteServiceV1;

/**
 * Class WriteServiceFactory.
 *
 * @package Language
 *
 * @license Proprietary
 */
class WriteServiceFactory
{
    /**
     * @return \Language\Infrastructure\Services\WriteServiceV1
     */
    public static function create()
    {
        return new WriteServiceV1(
            PathGeneratorFactory::create()
        );
    }
}
