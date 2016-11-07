<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

use Clubdeuce\WPLib\Components\GoogleMaps\Location_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestLocationModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Location_Model
 */
class TestLocationModel extends TestCase {

    /**
     * @var Location_Model
     */
    private $_location;

    public function setUp() {
        $this->_location = new Location_Model([
            'address'           => '1600 Amphitheatre Parkway Mountain View CA',
            'formatted_address' => '1600 Amphitheatre Parkway, Mountain View, CA, 12345',
            'latitude'          => 100.12345,
            'longitude'         => -100.12345,
            'place_id'          => 'foobar',
            'viewport'          => ['foo', 'bar'],
        ] );
    }

    /**
     * @covers ::__call
     */
    public function testAddress() {
        $this->assertEquals('1600 Amphitheatre Parkway Mountain View CA', $this->_location->address());
    }

    /**
     * @covers ::__call
     */
    public function testFormattedAddress() {
        $this->assertEquals('1600 Amphitheatre Parkway, Mountain View, CA, 12345', $this->_location->formatted_address());
    }

    /**
     * @covers ::__call
     */
    public function testLatitude() {
        $this->assertEquals(100.12345, $this->_location->latitude());
    }

    /**
     * @covers ::__call
     */
    public function testLongitude() {
        $this->assertEquals(-100.12345, $this->_location->longitude());
    }

    /**
     * @covers ::__call()
     */
    public function testPlaceId() {
        $this->assertEquals('foobar', $this->_location->place_id());
    }

    /**
     * @covers ::__call()
     */
    public function testViewport() {
        $this->assertEquals(['foo', 'bar'], $this->_location->viewport());
    }
}