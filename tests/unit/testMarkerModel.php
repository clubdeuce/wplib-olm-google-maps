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
     * @var Marker_Model
     */
    private $_model;

    /**
     * @var Mock
     */
    private $_geocoder;

	/**
	 * @var array
	 */
	private $_position = array( 'lat' => 37.4224764, 'lng' => -122.0842499);

    public function setUp() {

        $this->_geocoder = $this->getMockGeocoder();

        $this->_model = new Marker_Model([
            'address'  => $this->_address,
            'geocoder' => $this->_geocoder,
	        'title'    => 'Sample Title'
        ]);
    }


    /**
     * @covers ::latitude
     */
    public function testLatitude() {
        $this->assertEquals($this->_position['lat'], $this->_model->latitude());
    }

    /**
     * @covers ::longitude
     */
    public function testLongitude() {
        $this->assertEquals($this->_position['lng'], $this->_model->longitude());
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

	/**
	 * @covers ::position
	 */
    public function testPosition() {
    	$this->assertEquals($this->_position, $this->_model->position());
    }

	/**
	 * @covers ::title
	 */
    public function testTitle() {
    	$this->assertEquals('Sample Title', $this->_model->title());
    }

    public function testMarkerArgs() {

    	$args = $this->_model->marker_args();

	    $this->assertInternalType('array', $args);
	    $this->assertArrayHasKey('position', $args);
	    $this->assertArrayHasKey('label', $args);
	    $this->assertArrayHasKey('title', $args);
	    $this->assertEquals($this->_position, $args['position']);
	    $this->assertEquals('Sample Title', $args['title']);
    }
}
