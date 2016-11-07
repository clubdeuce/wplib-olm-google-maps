<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\GoogleMaps\Geocoder;
use Clubdeuce\WPLib\Components\GoogleMaps\Location;
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
     * @covers ::_make_location
     */
    public function testGeocode() {
        $location = $this->_geocoder->geocode('1600 Amphitheatre Parkway, Mountain View, CA');

        $this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Location', $location);
        $this->assertEquals('1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA', $location->address());
        $this->assertEquals('1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA', $location->formatted_address());
        $this->assertEquals(37.422366400000001, $location->latitude());
        $this->assertEquals(-122.084406, $location->longitude());
        $this->assertEquals('ChIJ2eUgeAK6j4ARbn5u_wAGqWA', $location->place_id());
        $this->assertInternalType('array', $location->viewport());
        $this->assertArrayHasKey('northeast', $location->viewport());
        $this->assertArrayHasKey('southwest', $location->viewport());
        $this->assertInternalType('array', $location->viewport()['northeast']);
        $this->assertArrayHasKey('lat', $location->viewport()['northeast']);
        $this->assertArrayHasKey('lng', $location->viewport()['northeast']);
        $this->assertEquals(37.423715380291497, $location->viewport()['northeast']['lat']);
        $this->assertEquals(-122.08305701970851, $location->viewport()['northeast']['lng']);
        $this->assertInternalType('array', $location->viewport()['southwest']);
        $this->assertArrayHasKey('lat', $location->viewport()['southwest']);
        $this->assertArrayHasKey('lng', $location->viewport()['southwest']);
        $this->assertEquals(37.421017419708512, $location->viewport()['southwest']['lat']);
        $this->assertEquals(-122.0857549802915, $location->viewport()['southwest']['lng']);
    }
}
