<?php
namespace Language\Domain\Factories;

use Language\Domain\Entities\Application;
use PHPUnit_Framework_TestCase;

/**
 * Test for ApplicationFactory.
 *
 * @package Language
 *
 * @license Proprietary
 */
class ApplicationFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateFromArray()
    {
        $applicationArray = [
            'firstApplication' => ['en', 'hu'],
            'secondApplication' => ['hu'],
        ];

        $applications = ApplicationFactory::createFromArray($applicationArray);

        $this->assertContainsOnlyInstancesOf(Application::class, $applications);
    }
}
