<?php
namespace Language\Domain\Factories;

use Language\Domain\ValueObjects\Language;
use PHPUnit_Framework_TestCase;

/**
 * Test for LanguageFactory.
 *
 * @package Language
 *
 * @license Proprietary
 */
class LanguageFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateFromArray()
    {
        $languageStrings = ['en', 'hu'];

        $languages = LanguageFactory::createFromArray($languageStrings);

        $this->assertContainsOnlyInstancesOf(Language::class, $languages);

        $this->assertEquals(
            ['code'=>'en', 'name'=>'english'],
            $languages[0]->jsonSerialize()
        );

        $this->assertEquals(
            ['code'=>'hu', 'name'=>'hungarian'],
            $languages[1]->jsonSerialize()
        );
    }
}

