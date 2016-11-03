<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

use Clubdeuce\WPLib\Components\GoogleMaps\Geocoder;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestGeocoder
 * @package Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Geocoder
 */
class TestGeocoder extends TestCase {

    /**
     * @var Geocoder
     */
    private $_geocoder;

    /**
     * @var string
     */
    private $_api_key = '12345';

    /**
     *
     */
    public function setUp() {
        $this->_geocoder = new Geocoder(['api_key' => $this->_api_key]);
    }

    /**
     * @covers ::__construct
     * @covers ::api_key
     */
    public function testConstructorWithAPIKey() {
        $this->assertEquals($this->_api_key, $this->_geocoder->api_key());
    }

    /**
     * @covers ::_make_url
     */
    public function testMakeUrl() {
        $response = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_url', '123 Anywhere Street New York 10001');

        $this->assertInternalType('string', $response);
        $this->assertRegExp('/address\=123\+Anywhere\+Street\+New\+York\+10001/', $response);
        $this->assertRegExp("/key={$this->_api_key}/", $response);
    }

    /**
     * @covers ::_parse_response
     */
    public function testParseResponse() {
        $response = $this->reflectionMethodInvokeArgs($this->_geocoder, '_parse_response', json_decode(file_get_contents(INCLUDES_DIR . '/geocoder-response.json'), true));

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('lat', $response);
        $this->assertArrayHasKey('lng', $response);
    }

    /**
     * @covers ::_make_request
     */
    public function testMakeRequestInvalidURL() {
        $response = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_request', 'foo.bar');
        $this->assertInstanceOf('WP_Error', $response);
    }

}