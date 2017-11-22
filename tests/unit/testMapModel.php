<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit;

use Clubdeuce\WPLib\Components\GoogleMaps\Map_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestMapModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Map_Model
 * @group              Map
 */
class TestMapModel extends TestCase {

	/**
	 * @var Map_Model
	 */
	private $_model;

	public function setUp() {
		$this->_model = new Map_Model(array(
			'map'    => $this->_mockMap(array('center' => array('lat' => 200, 'lng' => -200), 'zoom' => 13)),
			'label'  => $this->mockLabel(),
			'marker' => $this->mockMarker(),
		));
		parent::setUp();
	}

	/**
	 * @covers ::has_map
	 */
	public function testHasMap() {
		$this->assertTrue($this->_model->has_map());
	}

	/**
	 * @covers ::has_map
	 */
	public function testHasMapFalse() {
		$model = new Map_Model(array('map' => null));
		$this->assertFalse($model->has_map());
	}
	/**
	 * @covers ::__call
	 */
	public function testMagicMethods() {
		$this->assertEquals(array('lat' => 200, 'lng' => -200), $this->_model->center());
		$this->assertEquals(13, $this->_model->zoom());
	}

	/**
	 * @param array $args
	 *
	 * @return \Mockery\MockInterface
	 */
	private function _mockMap($args = array() ) {
		$map = \Mockery::mock(\Clubdeuce\WPGoogleMaps\Map::class);

		foreach ( $args as $key => $val ) {
			$map->shouldReceive($key)->andReturn($val);
		}

		return $map;
	}
}