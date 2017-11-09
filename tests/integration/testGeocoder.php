<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\GoogleMaps\Geocoder;
use Clubdeuce\WPLib\Components\GoogleMaps\Location;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestGeocoder
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Geocoder
 * @group              geocoder
 */
class TestGeocoder extends TestCase {

    /**
     * @var Geocoder;
     */
    private $_geocoder;

    public function setUp() {
        $this->_geocoder = new Geocoder(['api_key' => getenv('MAPS_API_KEY')]);
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
     * @covers ::_make_location
     */
    public function testGeocode() {
        $location = $this->_geocoder->geocode('1600 Amphitheatre Parkway, Mountain View, CA');

        $this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Location', $location);
        $this->assertInternalType('string', $location->address());
        $this->assertInternalType('string', $location->formatted_address());
        $this->assertInternalType('double', $location->latitude());
        $this->assertInternalType('double', $location->longitude());
        $this->assertInternalType('array', $location->viewport());
        $this->assertArrayHasKey('northeast', $location->viewport());
        $this->assertArrayHasKey('southwest', $location->viewport());
        $this->assertInternalType('array', $location->viewport()['northeast']);
        $this->assertArrayHasKey('lat', $location->viewport()['northeast']);
        $this->assertArrayHasKey('lng', $location->viewport()['northeast']);
        $this->assertInternalType('double', $location->viewport()['northeast']['lat']);
        $this->assertInternalType('double', $location->viewport()['northeast']['lng']);
        $this->assertInternalType('array', $location->viewport()['southwest']);
        $this->assertArrayHasKey('lat', $location->viewport()['southwest']);
        $this->assertArrayHasKey('lng', $location->viewport()['southwest']);
        $this->assertInternalType('double', $location->viewport()['southwest']['lat']);
        $this->assertInternalType('double', $location->viewport()['southwest']['lng']);
    }
}
