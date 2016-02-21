<?php
namespace Language\Domain\ValueObjects;

use PHPUnit_Framework_TestCase;

/**
 * Test for Language VO.
 *
 * @license Proprietary
 */
class LanguageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider invalidArgumentProvider
     *
     * @param mixed $languageCode Non-string argument
     *
     * @expectedException \InvalidArgumentException
     */
    public function testThrowExceptionOnNonString($languageCode)
    {
        new Language($languageCode);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testThrowExceptionOnWrongLanguageInput()
    {
        new Language('invalid-language-code');
    }

    public function acceptValidCodesOnly()
    {
        $firstValidLanguage = current(array_keys(Language::ALLOWED_LANGUAGES));

        new Language($firstValidLanguage);
    }

    public function testCastToString()
    {
        $this->assertEquals('english', new Language('en'));
    }

    public function testJsonSerializable()
    {
        $language = new Language('en');

        $this->assertJsonStringEqualsJsonString(
            '{"code":"en", "name":"english"}',
            json_encode($language)
        );
    }

    /**
     * @return array
     */
    public function invalidArgumentProvider()
    {
        return [
            [1],
            [new \stdClass()],
        ];
    }
}
