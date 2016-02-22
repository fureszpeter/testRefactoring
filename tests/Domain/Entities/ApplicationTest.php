<?php
namespace Language\Domain\Entities;

use Language\Domain\ValueObjects\Language;
use PHPUnit_Framework_TestCase;

/**
 * Test for Application entity.
 *
 * @package Language
 *
 * @license Proprietary
 */
class ApplicationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRequiredArgumentsWithNonString()
    {
        new Application(123, $this->getMockLanguage());
    }

    public function testValidConstructorPass()
    {
        $application = new Application('validName', $this->getMockLanguage());

        $this->assertEquals('validName', $application->getName());
        $this->assertEquals([$this->getMockLanguage()], $application->getLanguages());
    }

    public function testCastToString()
    {
        $application = new Application('name', $this->getMockLanguage());

        $this->assertEquals('name', $application);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Language\Domain\ValueObjects\Language
     */
    private function getMockLanguage()
    {
        $app = $this->getMockBuilder(Language::class)->disableOriginalConstructor()->getMock();
        $app->expects($this->any())->method('getLanguageCode')->willReturn('en');
        $app->expects($this->any())->method('getLanguageName')->willReturn('english');

        return $app;
    }
}
