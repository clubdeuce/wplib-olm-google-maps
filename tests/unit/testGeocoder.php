<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

use Clubdeuce\WPLib\Components\GoogleMaps\Geocoder;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestGeocoder
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Geocoder
 * @group              geocoder
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
        $response = json_decode($this->get_sample_response(), true);
        $location = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_location', $response['results'][0] );

        $this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Location', $location);
        $this->assertEquals('1600 Amphitheatre Parkway, Mountain View, CA 94043, USA', $location->address());
        $this->assertEquals('1600 Amphitheatre Parkway, Mountain View, CA 94043, USA', $location->formatted_address());
        $this->assertEquals(37.4224764, $location->latitude());
        $this->assertEquals(-122.0842499, $location->longitude());
        $this->assertEquals('ChIJ2eUgeAK6j4ARbn5u_wAGqWA', $location->place_id());
        $this->assertInternalType('array', $location->viewport());
        $this->assertArrayHasKey('northeast', $location->viewport());
        $this->assertArrayHasKey('southwest', $location->viewport());
        $this->assertInternalType('array', $location->viewport()['northeast']);
        $this->assertArrayHasKey('lat', $location->viewport()['northeast']);
        $this->assertArrayHasKey('lng', $location->viewport()['northeast']);
        $this->assertEquals(37.4238253802915, $location->viewport()['northeast']['lat']);
        $this->assertEquals(-122.0829009197085, $location->viewport()['northeast']['lng']);
        $this->assertInternalType('array', $location->viewport()['southwest']);
        $this->assertArrayHasKey('lat', $location->viewport()['southwest']);
        $this->assertArrayHasKey('lng', $location->viewport()['southwest']);
        $this->assertEquals(37.4211274197085, $location->viewport()['southwest']['lat']);
        $this->assertEquals(-122.0855988802915, $location->viewport()['southwest']['lng']);
    }

    /**
     * @covers ::_make_request
     */
    public function testMakeRequestInvalidURL() {
        $response = $this->reflectionMethodInvokeArgs($this->_geocoder, '_make_request', 'foo.bar');
        $this->assertInstanceOf('WP_Error', $response);
    }

}