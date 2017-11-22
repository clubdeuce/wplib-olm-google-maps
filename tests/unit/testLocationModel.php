<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit;

use Clubdeuce\WPGoogleMaps\Location as MLoc;
use Clubdeuce\WPGoogleMaps\Location as Loc;
use Clubdeuce\WPLib\Components\GoogleMaps\Location_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestLocationModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Location_Model
 * @group              Location
 */
class TestLocationModel extends TestCase {

	/**
	 * @var Location_Model
	 */
	private $_location;

	public function setUp() {
		$this->_location = new Location_Model(array('location' => $this->_getMockLocation()));
		parent::setUp();
	}

	/**
	 * @covers ::__construct
	 * @covers ::__call
	 */
	public function testConstruct() {
		$this->assertEquals(self::_getMockLocation(), $this->_location->location());
	}

	/**
	 * @covers ::__construct
	 * @covers ::__call
	 */
	public function testConstructDefaults() {
		$location = new Location_Model();
		$this->assertTrue($location->has_location());
		$this->assertInstanceOf(Loc::class, $location->location());
	}

	/**
	 * @covers ::__construct
	 * @covers ::has_location
	 */
	public function testHasLocation() {
		$this->assertTrue($this->_location->has_location());
	}

	/**
	 * @covers ::__call
	 */
	public function testMagicMethodCall() {
		$this->assertEquals('bar', $this->_location->foo());
	}

	/**
	 * @covers ::__call
	 */
	public function testMagicMethodCallNull() {
		$location = new Location_Model(array('location' => null));
		$this->assertNull($location->latitude());
	}

	/**
	 * @return \Mockery\MockInterface
	 */
	private function _getMockLocation() {
		$location = \Mockery::mock(MLoc::class);

		$location->shouldReceive('foo')->andReturn('bar');

		return $location;
	}
}