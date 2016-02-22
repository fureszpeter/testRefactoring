<?php
namespace Language\Domain\Factories;

use Language\Infrastructure\Services\ApiClientV1;

/**
 * Class ApiClientFactory.
 *
 * @package Language
 *
 * @license Proprietary
 */
class ApiClientFactory
{
    /**
     * @return \Language\Infrastructure\Services\ApiClientV1
     */
    public static function create()
    {
        return new ApiClientV1();
    }
}
