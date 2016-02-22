<?php
namespace Language\Domain\Factories;

use Language\Infrastructure\Services\ApiDownloadService;

/**
 * Class DownloadServiceFactory.
 *
 * @package Language
 *
 * @license Proprietary
 */
class DownloadServiceFactory
{
    /**
     * @return \Language\Infrastructure\Services\ApiDownloadService
     */
    public static function create()
    {
        return new ApiDownloadService(
            ApiClientFactory::create()
        );
    }
}
