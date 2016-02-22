<?php
namespace Language\Domain\ValueObjects;

use PHPUnit_Framework_TestCase;

/**
 * Test for Language VO.
 *
 * @license Proprietary
 */
class TranslationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowExceptionOnNonStringContent()
    {
        $mockLanguage = $this->getMockLanguage();
        new Translation($mockLanguage, 123);
    }

    public function testGetLanguageReturnsLanguage()
    {
        $mockLanguage = $this->getMockLanguage();

        $translation = new Translation($mockLanguage, 'translation');

        $this->assertSame($mockLanguage, $translation->getLanguage());
    }

    public function testGetContentReturnsContent()
    {
        $mockLanguage = $this->getMockLanguage();

        $translation = new Translation($mockLanguage, 'translation');

        $this->assertEquals('translation', $translation->getContent());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Language\Domain\ValueObjects\Language
     */
    private function getMockLanguage()
    {
        $mockLanguage = $this->getMockBuilder(Language::class)->disableOriginalConstructor()->getMock();

        return $mockLanguage;
    }
}
