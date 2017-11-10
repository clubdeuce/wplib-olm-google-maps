<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\GoogleMaps\Marker;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestMarkerModel
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @coversDefaultClass Clubdeuce\WPLib\Components\GoogleMaps\Marker
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
	 * @covers \Clubdeuce\WPLib\Components\GoogleMaps\Marker_Model::location
	 */
	public function testLocation() {
		$this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Location', $this->_marker->location());
	}
}