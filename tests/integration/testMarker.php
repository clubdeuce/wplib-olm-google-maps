<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\GoogleMaps\Marker;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestMarkerModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model
 * @group              Marker
 * @group              Integration
 */
class TestMarker extends TestCase {

	/**
	 * @var Marker
	 */
	private $_marker;

	public function setUp() {
		$this->_marker = new Marker(array(
			'address'  => '1600 Amphitheatre Parkway, Mountain View, CA 94043, USA',
			'title'    => 'Sample Location'
		));
		parent::setUp();
	}

	/**
	 * @covers ::location
	 */
	public function testLocation() {
		$marker = $this->_marker;

		$this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Location', $this->_marker->location());
		$this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Marker_Label', $marker->label());
		$this->assertInternalType('double', $marker->latitude());
		$this->assertInternalType('double', $marker->longitude());
		$this->assertInternalType('string', $marker->title());
		$this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Info_Window', $marker->info_window());
		$this->assertInternalType('array', $marker->marker_args());
	}

	/**
	 * @coversNothing
	 */
	public function testInfoWindow() {
		$window = $this->_marker->info_window();

		$this->assertInternalType('string', $window->content());
		$this->assertInternalType('integer', $window->pixel_offset());
		$this->assertInternalType('array', $window->position());
		$this->assertNull($window->max_width());
	}

	/**
	 * @coversNothing
	 */
	public function testMarkerLabel() {
		$label = $this->_marker->label();

		$this->assertInternalType('string', $label->color(), 'Color is not a string');
		$this->assertInternalType('string', $label->font_family(), 'font_family is not a string');
		$this->assertInternalType('string', $label->font_size(), 'font_size is not a string');
		$this->assertInternalType('string', $label->font_weight());
		$this->assertInternalType('string', $label->text());
	}

}
