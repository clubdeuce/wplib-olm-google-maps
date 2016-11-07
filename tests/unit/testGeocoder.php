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
     * @covers ::_get_data
     */
    public function testGetDataCache() {
        wp_cache_add( md5(serialize('foo.bar')), 'foobar');

        $this->assertEquals('foobar', $this->reflectionMethodInvokeArgs($this->_geocoder, '_get_data', 'foo.bar'));
    }

    /**
     * @covers ::_make_location
     */
    public function testMakeLocation() {
        $response = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_location', json_decode(file_get_contents(INCLUDES_DIR . '/geocoder-response.json'), true));

        $this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Location', $response);
    }

    /**
     * @covers ::_make_request
     */
    public function testMakeRequestInvalidURL() {
        $response = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_request', 'foo.bar');
        $this->assertInstanceOf('WP_Error', $response);
    }

}