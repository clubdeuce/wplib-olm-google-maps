<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit;

use Clubdeuce\WPGoogleMaps\Google_Maps as GM;
use Clubdeuce\WPLib\Components\Google_Maps;
use Clubdeuce\WPLib\Components\GoogleMaps\Map;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class testGoogleMaps
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Unit
 * @coversDefaultClass \Clubdeuce\WPLib\Components\Google_Maps
 */
class testGoogleMaps extends TestCase {

	/**
	 * @covers ::on_load
	 */
	public function testAutoloadWorks() {

		Google_Maps::on_load();
		$this->assertTrue(class_exists(GM::class));

	}

	/**
	 * @covers ::make_new_map
	 */
	public function testMakeNewMapReturnsMyMap() {

		$map = Google_Maps::make_new_map(array(
			'center' => array('lat' => 123.45, 'lng' => '-123.45')
		));

		$this->assertInstanceOf(Map::class, $map);

	}

	/**
	 * @covers ::make_marker_by_address
	 */
	public function testMakeMarkerByAddress() {

		$marker = Google_Maps::make_marker_by_address('1600 Pennsylvania Avenue NW Washington DC');

		$this->assertInstanceOf(Marker::class, $marker);

	}

	/**
	 * @covers ::make_marker_by_position
	 */
	public function testMakeMarkerByPosition() {

		$marker = Google_Maps::make_marker_by_position(123.45, -123.45);

		$this->assertInstanceOf(Marker::class, $marker);
		$this->assertEquals(123.45, $marker->latitude());
		$this->assertEquals(-123.45, $marker->longitude());

	}
}