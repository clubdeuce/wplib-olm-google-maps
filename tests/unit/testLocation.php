<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\GoogleMaps\Location;
use Clubdeuce\WPLib\Components\GoogleMaps\Location_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestLocation
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @group              Location
 */
class TestLocation extends TestCase {

	/**
	 * @var Location
	 */
	private $_location;

	public function setUp() {
		$this->_location = new Location();
		parent::setUp();
	}

	/**
	 * @coversNothing
	 */
	public function testConstruct() {
		$this->assertInstanceOf(Location_Model::class, $this->_location->model());
		$this->assertTrue($this->_location->has_location());
		$this->assertInstanceOf(\Clubdeuce\WPGoogleMaps\Location::class, $this->_location->location());
	}
}