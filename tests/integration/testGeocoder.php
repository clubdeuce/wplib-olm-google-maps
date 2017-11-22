<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\GoogleMaps\Geocoder;
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
        $this->_geocoder = new Geocoder(array('api_key' => getenv('MAPS_API_KEY')));
	    parent::setUp();
    }

    /**
     * @covers ::geocode
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
