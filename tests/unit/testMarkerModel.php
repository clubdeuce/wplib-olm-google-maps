<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

use Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;
use Mockery\Mock;

/**
 * Class TestMarkerModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model
 */
class TestMarkerModel extends TestCase {

    /**
     * @var Marker_Model
     */
    private $_model;

    /**
     * @var string
     */
    private $_address = '1600 Amphitheatre Parkway Mountain View CA';

    /**
     * @var Mock
     */
    private $_geocoder;

    /**
     * @var array
     */
    private $_latlng = ['lat' => 100.2345325, 'lng' => -45.23423423567];

    public function setUp() {
        $this->_geocoder = \Mockery::mock('\Clubdeuce\WPLib\Components\GoogleMaps\Geocoder');
        $this->_geocoder->shouldReceive('geocode')->andReturn($this->_latlng);

        $this->_model = new Marker_Model([
            'address'  => $this->_address,
            'geocoder' => $this->_geocoder,
        ]);
    }


    /**
     * @covers ::latlng_object
     */
    public function testLatLngObject() {
        $latlng = $this->_model->latlng_object();

        $this->assertJson($latlng);
        $this->assertEquals(json_encode($this->_latlng), $latlng);
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