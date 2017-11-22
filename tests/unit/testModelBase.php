<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit;

use Clubdeuce\WPLib\Components\GoogleMaps\Model_Base;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestModelBase
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Model_Base
 * @group              Map
 */
class TestModelBase extends TestCase {

	/**
	 * @var Model_Base
	 */
	private $_model;

	public function setUp() {
		$this->_model = new Test_Base();
		parent::setUp();
	}

	/**
	 * @covers ::_has
	 */
	public function testHas() {
		$this->assertTrue($this->reflectionMethodInvokeArgs($this->_model, '_has', 'foo'));
		$this->assertFalse($this->reflectionMethodInvokeArgs($this->_model, '_has', 'bar'));
	}

	/**
	 * @covers ::__call
	 */
	public function testMagicCall() {
		$this->assertEquals('bar', $this->_model->foo());
	}
}

/**
 * Class Test_Base
 * @package Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit
 */
class Test_Base extends Model_Base {

	/**
	 * @var string
	 */
	protected $_foo = 'bar';
}