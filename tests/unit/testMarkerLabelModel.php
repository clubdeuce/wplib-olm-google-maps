<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

use Clubdeuce\WPLib\Components\GoogleMaps\Marker_Label_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class testMarkerLabelModel
 * @package Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests
 * 
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Marker_Label_Model
 * 
 * @group MarkerLabel
 * @group Marker
 */
class testMarkerLabelModel extends TestCase {

	/**
	 * @var Marker_Label_Model
	 */
	private $_model;

	public function setUp() {

		$this->_model = new Marker_Label_Model();
		parent::setUp();

	}

	/**
	 * @covers ::color
	 * @covers ::font_family
	 * @covers ::font_size
	 * @covers ::font_weight
	 * @covers ::text
	 */
	public function testDefaults() {


		$this->assertEquals('black', $this->_model->color());
		$this->assertInternalType('string', $this->_model->font_family());
		$this->assertEmpty($this->_model->font_family());
		$this->assertEquals('14px', $this->_model->font_size());
		$this->assertEquals('400', $this->_model->font_weight());
		$this->assertInternalType('string', $this->_model->text());
		$this->assertEmpty($this->_model->text());

	}

	/**
	 * @covers ::color
	 * @covers ::font_family
	 * @covers ::font_size
	 * @covers ::font_weight
	 * @covers ::text
	 */
	public function testPassedArguments() {

		$model = new Marker_Label_Model(array(
			'color'       => 'blue',
			'font_family' => 'Arial',
			'font_size'   => '22px',
			'font_weight' => 900,
			'text'        => 'Lorem ipsum dolor est',
		));

		$this->assertEquals('blue', $model->color());
		$this->assertEquals('Arial', $model->font_family());
		$this->assertEquals('22px', $model->font_size());
		$this->assertEquals('900', $model->font_weight());
		$this->assertEquals('Lorem ipsum dolor est', $model->text());

	}

}