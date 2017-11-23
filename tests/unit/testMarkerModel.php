<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit;

use Clubdeuce\WPLib\Components\GoogleMaps\Info_Window;
use Clubdeuce\WPLib\Components\GoogleMaps\Location;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker_Label;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestMarkerModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model
 * @group              Map
 */
class TestMarkerModel extends TestCase {

	/**
	 * @var Marker_Model
	 */
	private $_model;

	public function setUp() {
		$this->_model = new Marker_Model(array(
			'marker' => $this->_mock(array(
				'label'       => new \stdClass(),
				'location'    => new \stdClass(),
				'info_window' => self::_mock(array(
					'set_position' => null,
				)),
				'latitude'    => 100,
				'longitude'   => -100,
			)),
		));
		parent::setUp();
	}

	/**
	 * @covers ::__construct
	 * @covers ::has_marker
	 */
	public function testHasMarker() {
		$this->assertTrue($this->_model->has_marker());
	}

	/**
	 * @covers ::__call
	 */
	public function testMagicCall() {
		$this->assertEquals('bar', $this->_model->foo());
	}

	/**
	 * @covers ::label
	 */
	public function testLabel() {
		$this->assertInstanceOf(Marker_Label::class, $this->_model->label());
	}

	/**
	 * @covers ::location
	 */
	public function testLocation() {
		$this->assertInstanceOf(Location::class, $this->_model->location());
	}

	/**
	 * @covers ::info_window
	 */
	public function testInfoWindow() {
		$this->assertInstanceOf(Info_Window::class, $this->_model->info_window());
	}
}