<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit;

use Clubdeuce\WPLib\Components\GoogleMaps\Marker_Label_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestMarkerLabelModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Marker_Label_Model
 * @group              Map
 */
class TestMarkerLabelModel extends TestCase {

	/**
	 * @var Marker_Label_Model
	 */
	private $_model;

	public function setUp() {
		$this->_model = new Marker_Label_Model(array(
			'label' => $this->_mockLabel(),
		));
		parent::setUp();
	}

	/**
	 * @covers ::has_label
	 */
	public function testHasLabel() {
		$this->assertTrue($this->_model->has_label());
	}

	/**
	 *
	 */
	public function testMagicCall() {
		$this->assertEquals('bar', $this->_model->foo());
	}

	/**
	 * @param array $args
	 *
	 * @return \Mockery\MockInterface
	 */
	private function _mockLabel($args = array()) {
		$mock = \Mockery::mock();

		$args = wp_parse_args($args, array(
			'foo' => 'bar',
		));

		foreach ($args as $key => $val) {
			$mock->shouldReceive($key)->andReturn($val);
		}

		return $mock;
	}
}
