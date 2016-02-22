<?php
namespace Language\Domain\Factories;

use Language\Domain\Entities\Application;

/**
 * Factory for Application entity.
 *
 * @package Language
 *
 * @license Proprietary
 */
class ApplicationFactory
{
    /**
     * @param array $applicationArray
     *
     * @return \Language\Domain\Entities\Application[]
     */
    public static function createFromArray(array $applicationArray)
    {
        $applications = [];

        foreach ($applicationArray as $name => $languages) {
            $applications[] = new Application($name, ...LanguageFactory::createFromArray($languages));
        }

        return $applications;
    }
}
