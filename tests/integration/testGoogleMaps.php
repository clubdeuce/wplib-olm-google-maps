<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\Google_Maps;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestGoogleMaps
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @coversDefaultClass Clubdeuce\WPLib\Components\Google_Maps
 * @group              Google_Maps
 * @group              Integration
 */
class TestGoogleMaps extends TestCase {

	public function setUp() {
		Google_Maps::register_script_condition(true);
		wp_enqueue_scripts();
	}

	/**
	 * @coversNothing
	 */
	function testScriptRegistered() {
		$this->assertTrue(wp_script_is('google-maps', 'registered'));
		$this->assertTrue(wp_script_is('map-control', 'registered'));
	}

	/**
	 * @coversNothing
	 * @depends testScriptRegistered
	 */
	function testScriptEnqueued() {

		$this->assertTrue(wp_script_is('google-maps', 'enqueued'));
		$this->assertTrue(wp_script_is('map-control', 'enqueued'));

	}
}