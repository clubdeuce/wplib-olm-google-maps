<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

use Clubdeuce\WPLib\Components\GoogleMaps\Info_Window_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestInfoWindowModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Info_Window_Model
 * @group              InfoWindow
 */
class TestInfoWindowModel extends TestCase {

	/**
	 * @var Info_Window_Model
	 */
	private $_model;

	public function setUp() {

		$this->_model = new Info_Window_Model(array(
			'content'      => 'Lorem ipsum dolor est.',
			'pixel_offset' => 20,
			'position'    => array('lat' => 100.946382, 'lng' => -100.9473927),
			'max_width'    => 500,

		));
		parent::setUp();

	}

	/**
	 * @covers ::content
	 */
	public function testContent() {

		$this->assertEquals('Lorem ipsum dolor est.', $this->_model->content());

	}

	/**
	 * @covers ::pixel_offset
	 */
	public function testPixelOffset() {

		$this->assertEquals(20, $this->_model->pixel_offset());

	}

	/**
	 * @covers ::position
	 */
	public function testPosition() {

		$this->assertEquals(array('lat' => 100.946382, 'lng' => -100.9473927), $this->_model->position());

	}

	/**
	 * @covers ::max_width
	 */
	public function testMaxWidth() {

		$this->assertEquals(500, $this->_model->max_width());

	}

}
