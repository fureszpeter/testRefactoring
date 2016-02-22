<?php
namespace Language\Domain\Entities;

use Language\Domain\ValueObjects\Language;
use PHPUnit_Framework_TestCase;

/**
 * Test for Applet Entity.
 *
 * @package Language
 *
 * @license Proprietary
 */
class AppletTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowExceptionOnNonStringAppletId()
    {
        new Applet(1, 'someDir');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowExceptionOnNonStringDirectory()
    {
        new Applet('myId', 123);
    }

    public function testCanCastToString()
    {
        $applet = new Applet('myId', '/myDir');

        $this->assertEquals('myId', $applet);
    }

    public function testJsonSerialize()
    {
        $expectedArray = [
            'id' => 'myId',
            'directory' => '/myDir',
            'languages' => [
                ['code' => 'en', 'name' => 'english'],
            ],
        ];

        $applet = new Applet('myId', '/myDir');
        $applet->setLanguages(new Language('en'));

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedArray),
            json_encode($applet)
        );
    }
}
