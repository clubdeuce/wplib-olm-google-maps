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
class testLocation extends TestCase {

	/**
	 * @var Location
	 */
	private $_location;

	public function setUp() {
		$this->_location = new Location(array(
			'address'           => 'Foo Address',
			'formatted_address' => 'Foo Formatted Address',
			'state'             => 'NY',
			'zip_code'          => '10001',
			'latitude'          => 123.45,
			'longitude'         => -123.45,
			'location_type'     => 'foo_location_type',
			'place_id'          => 'foo_id',
			'viewport'          => array('foo', 'bar'),

		) );
		parent::setUp();
	}

	/**
	 * @covers \ClubDeuce\WPLib\Components\GoogleMaps\Location::__construct
	 * @covers \ClubDeuce\WPLib\Components\GoogleMaps\Location_Model::__construct
	 */
	public function testLocation() {
		$location = $this->_location;

		$this->assertInstanceOf(Location::class, $location);
		$this->assertInstanceOf(Location_Model::class, $location->model());
		$this->assertTrue($this->_location->has_location());
		$this->assertInstanceOf(\Clubdeuce\WPGoogleMaps\Location::class, $location->location());
		$this->assertEquals('Foo Address', $location->address());
		$this->assertEquals('Foo Formatted Address', $location->formatted_address());
		$this->assertEquals('NY', $location->state());
		$this->assertEquals('10001', $location->zip_code());
		$this->assertEquals(123.45, $location->latitude());
		$this->assertEquals(-123.45, $location->longitude());
		$this->assertEquals('foo_location_type', $location->location_type());
		$this->assertEquals('foo_id', $location->place_id());
		$this->assertEquals(array('foo', 'bar'), $location->viewport());
	}
}