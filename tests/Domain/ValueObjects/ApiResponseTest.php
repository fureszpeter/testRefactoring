<?php
namespace Language\Domain\ValueObjects;

use PHPUnit_Framework_TestCase;

/**
 * Test for ApiResponse VO.
 *
 * @package Language
 *
 * @license Proprietary
 */
class ApiResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowExceptionOnInvalidStatus()
    {
        new ApiResponse(12, 'data');
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testThrowExceptionOnUnexpectedStatus()
    {
        new ApiResponse(ApiResponse::STATUS_VALID . '-invalidate', 'data');
    }

    public function testGetDataReturnsData()
    {
        $apiResponse = new ApiResponse(ApiResponse::STATUS_VALID, 'myData');

        $this->assertEquals('myData', $apiResponse->getData());
    }

    public function testGetStatusReturnsStatus()
    {
        $apiResponse = new ApiResponse(ApiResponse::STATUS_VALID, 'myData');

        $this->assertEquals(ApiResponse::STATUS_VALID, $apiResponse->getStatus());
    }

    public function testJsonSerialize()
    {
        $expectedArray = [
            'status' => ApiResponse::STATUS_VALID,
            'data' => 'myData',
        ];

        $apiResponse = new ApiResponse(ApiResponse::STATUS_VALID, 'myData');

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedArray),
            json_encode($apiResponse)
        );
    }
}
