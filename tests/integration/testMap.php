<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\Google_Maps;
use Clubdeuce\WPLib\Components\GoogleMaps\Info_Window;
use Clubdeuce\WPLib\Components\GoogleMaps\Location;
use Clubdeuce\WPLib\Components\GoogleMaps\Map;
use Clubdeuce\WPLib\Components\GoogleMaps\Map_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker_Label;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestMap
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @group              Location
 */
class TestMap extends TestCase {

	/**
	 * @var Map
	 */
	private $_map;

	public function setUp() {
		$marker = Google_Maps::make_marker_by_address(
			'1600 Pennsylvania Avenue NW Washington DC',
			array('title' => 'The White House')
		);
		$marker_2 = Google_Maps::make_marker_by_position(123.456, -123.456);

		$label  = $marker->label();
		$info   = $marker->info_window();

		$label->set_color('taupe');
		$label->set_font_family('Garamond');
		$label->set_font_size('22px');
		$label->set_font_weight(900);
		$label->set_text( 'Z' );

		$info->set_content('Foo Content');
		$info->set_max_width(200);
		$info->set_pixel_offset(12);

		$this->_map = new Map(array(
			'center'  => array('lat' => 100, 'lng' => -100),
			'zoom'    => 4,
			'html_id' => 'foo-map-id'
		));

		$this->_map->add_markers(array($marker, $marker_2));
		parent::setUp();
	}

	/**
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Map::__construct
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Map_Model::__construct
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Map_Model::__call
	 */
	public function testMap() {
		$map = $this->_map;
		$this->assertInstanceOf(Map::class, $map);
		$this->assertEquals(array('lat' => 100, 'lng' => -100), $map->center());
		$this->assertEquals(4, $map->zoom());
		$this->assertInstanceOf(\Clubdeuce\WPGoogleMaps\Map::class, $map->map());
	}

	/**
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Map_Model::add_markers
	 * @covers \Clubdeuce\WPLib\Components\Google_Maps::make_marker_by_address
	 */
	public function testMarkerByAddress() {
		$marker = $this->_map->markers()[0];

		$this->assertInstanceOf(Marker_Label::class, $marker->label());
		$this->assertInstanceOf(Info_Window::class, $marker->info_window());
		$this->assertInstanceOf(Location::class, $marker->location());
		$this->assertEquals(38.897663299999998, $marker->latitude());
		$this->assertEquals(-77.036573899999993, $marker->longitude());
		$this->assertEquals('The White House', $marker->title());
	}

	/**
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Map_Model::add_markers
	 * @covers \Clubdeuce\WPLib\Components\Google_Maps::make_marker_by_position
	 */
	public function testMarkerByPosition() {
		$marker = $this->_map->markers()[1];

		$this->assertInstanceOf(Marker_Label::class, $marker->label());
		$this->assertInstanceOf(Info_Window::class, $marker->info_window());
		$this->assertInstanceOf(Location::class, $marker->location());
		$this->assertEquals(123.456, $marker->latitude());
		$this->assertEquals(-123.456, $marker->longitude());
	}

	/**
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Map::__construct
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Marker_Label::__construct
	 */
	public function testMarkerLabel() {
		$label = $this->_map->markers()[0]->label();

		$this->assertEquals('taupe', $label->color());
		$this->assertEquals('Garamond', $label->font_family());
		$this->assertEquals('22px', $label->font_size());
		$this->assertEquals(900, $label->font_weight());
		$this->assertEquals('Z', $label->text());
	}

	/**
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Map::__construct
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Info_Window::__construct
	 */
	public function testInfoWindow() {
		$window = $this->_map->markers()[0]->info_window();

		$this->assertInternalType('array', $window->position());
		$this->assertEquals(array('lat' => 38.897663299999998, 'lng' => -77.036573899999993), $window->position());
		$this->assertEquals('Foo Content', $window->content());
		$this->assertEquals(12, $window->pixel_offset());
		$this->assertEquals(200, $window->max_width());
	}

	/**
	 * @coversNothing
	 */
	public function testTheMap() {
		ob_start();
		$this->_map->the_map();
		$output = ob_get_clean();

		$this->assertRegExp('#^<div id="foo-map-id"#', $output);
		$this->assertRegExp('#class="wp-google-map *.*?"#', $output);
	}
}