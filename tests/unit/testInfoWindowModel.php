<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit;

use Clubdeuce\WPGoogleMaps\Info_Window as MIW;
use Clubdeuce\WPLib\Components\GoogleMaps\Info_Window_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestInfoWindowModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Info_Window_Model
 * @group              InfoWindow
 */
class TestInfoWindowModel extends TestCase {

	/**
	 * @var Info_Window_Model
	 */
	private $_model;

	public function setUp() {

		$this->_model = new Info_Window_Model(array('info_window' => self::_get_mock_info_window()));
		parent::setUp();
	}

	/**
	 * @covers ::__construct
	 * @covers ::__call
	 */
	public function testInfoWindowIsSet() {
		$this->assertEquals(self::_get_mock_info_window(), $this->_model->info_window());
	}

	/**
	 * @covers ::has_info_window
	 */
	public function testHasInfoWindow() {
		$this->assertTrue($this->_model->has_info_window());
	}

	/**
	 * @covers ::__call
	 */
	public function testMagicMethods() {
		$this->assertEquals('Sample Info Window Content', $this->_model->content());
		$this->assertEquals('12', $this->_model->pixel_offset());
		$this->assertEquals(array('lat' => 123.45, 'lng' => -123.45), $this->_model->position());
		$this->assertEquals('450px', $this->_model->max_width());
	}

	/**
	 * @covers ::__call
	 */
	public function testMagicMethodNull() {
		$window = new Info_Window_Model(array('info_window' => null));

		$this->assertNull($window->content());
	}

	/**
	 * @return \Mockery\MockInterface
	 */
	private function _get_mock_info_window() {
		$mock = \Mockery::mock(MIW::class);
		$mock->shouldReceive('content')->andReturn('Sample Info Window Content');
		$mock->shouldReceive('pixel_offset')->andReturn(12);
		$mock->shouldReceive('position')->andReturn(array('lat' => 123.45, 'lng' => -123.45));
		$mock->shouldReceive('max_width')->andReturn('450px');

		return $mock;
	}
}
