<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

use Clubdeuce\WPLib\Components\GoogleMaps\Location;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;
use Mockery\Loader;
use Mockery\Mock;

/**
 * Class TestMarkerModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model
 * @group              Marker
 */
class TestMarkerModel extends TestCase {

    /**
     * @var Location
     */
    private $_location;

    /**
     * @var Marker_Model
     */
    private $_model;

    /**
     * @var Mock
     */
    private $_geocoder;


    public function setUp() {
        $this->_location = new Location([
            'address'           => '123 Anywhere Street Anywhere NY',
            'formatted_address' => '123 Anywhere Street, Anywhere, NY 12345 USA',
            'latitude'          => 100.12345,
            'longitude'         => -100.12345,
            'place_id'          => 'foobar',
            'types'             => ['foo', 'bar'],
            'viewport'          => ['northeast' => ['lat' => 100.12346, 'lng' => -100.12344], 'southwest' => ['lat' => 100.12344, 'lng' => -100.12346]],
        ]);

        $this->_geocoder = \Mockery::mock('\Clubdeuce\WPLib\Components\GoogleMaps\Geocoder');
        $this->_geocoder->shouldReceive('geocode')->andReturn($this->_location);

        $this->_model = new Marker_Model([
            'address'  => $this->_address,
            'geocoder' => $this->_geocoder,
        ]);
    }


    /**
     * @covers ::latitude
     */
    public function testLatitude() {
        $this->assertEquals(100.12345, $this->_model->latitude());
    }

    /**
     * @covers ::location
     */
    public function testLocation() {
        $this->assertEquals($this->_location, $this->_model->location());
    }

    /**
     * @covers ::longitude
     */
    public function testLongitude() {
        $this->assertEquals(-100.12345, $this->_model->longitude());
    }

    /**
     * @covers ::_geocoder
     */
    public function testGeocoder() {
        $this->assertEquals($this->_geocoder, $this->reflectionMethodInvoke($this->_model, '_geocoder'));
    }

    /**
     * @covers ::_geocoder
     */
    public function testCreateGeocoder() {
        $marker_model = new Marker_Model();
        $this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Geocoder',  $this->reflectionMethodInvoke($marker_model, '_geocoder'));
    }
}