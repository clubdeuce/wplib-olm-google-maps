<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

use Clubdeuce\WPLib\Components\GoogleMaps\Map_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class testMapModel
 * @package Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Map_Model
 * @group Map
 */
class testMapModel extends TestCase {

    /**
     * @var array
     */
    private $_center = array( 'lat' => 100, 'lng' => -100 );

    /**
     * @var Map_Model
     */
    private $_model;
    
    public function setUp() {
        
        $this->_model = new Map_Model(array('center' => $this->_center, 'markers' => array('foo', 'bar', 'baz'), 'zoom' => 12));
        
    }

    /**
     * @covers ::center
     */
    public function testCenter() {

        $this->assertEquals($this->_center, $this->_model->center());

    }

    /**
     * @covers ::markers
     */
    public function testMarkers() {

        $this->assertEquals(array('foo','bar','baz'), $this->_model->markers());

    }

    /**
     * @depends testMarkers
     * @covers ::add_marker
     */
    function testAddMarker() {

        $this->_model->add_marker('foobar');

        $this->assertContains('foobar', $this->_model->markers());

    }

    /**
     * @depends testMarkers
     * @covers ::add_markers
     */
    function testAddMarkers() {

        $this->_model->add_markers(array('foobar', 'barbaz'));

        $markers = $this->_model->markers();

        $this->assertContains('foobar', $markers);
        $this->assertContains('barbaz', $markers);

    }

    /**
     * @covers ::zoom
     */
    public function testZoom() {
        $this->assertEquals(12, $this->_model->zoom());
    }
}
