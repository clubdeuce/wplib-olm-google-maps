<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\GoogleMaps\Geocoder;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestGeocoder
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Geocoder
 */
class TestGeocoder extends TestCase {

    /**
     * @var Geocoder;
     */
    private $_geocoder;

    public function setUp() {
        $this->_geocoder = new Geocoder(['api_key' => '']);
    }

    /**
     * @covers ::_make_request
     */
    public function testMakeRequest() {
        $url      = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_url', '1600 Amphitheatre Parkway, Mountain View, CA');
        $response = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_request', $url);

        $this->assertInternalType('array', $response);
    }

    /**
     * @covers ::_make_request
     */
    public function testMakeRequestError404() {
        $response = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_request', 'https://maps.googleapis.com/maps/api/geo');

        $this->assertInstanceOf('WP_Error', $response);
        $this->assertObjectHasAttribute('errors', $response);
        $this->assertArrayHasKey('404', $response->errors);
    }

    /**
     * @covers ::_get_data
     */
    public function testGetData() {
        $url      = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_url', '1600 Amphitheatre Parkway, Mountain View, CA');
        $response = $this->reflectionMethodInvokeArgs($this->_geocoder, '_get_data', $url);

        $this->assertInternalType('array', $response);
    }

    /**
     * @covers ::geocode
     */
    public function testGeocode() {
        $result = $this->_geocoder->geocode('1600 Amphitheatre Parkway, Mountain View, CA');

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey('lat', $result);
        $this->assertArrayHasKey('lng', $result);
    }
}
