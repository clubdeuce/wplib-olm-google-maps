<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration;

use Clubdeuce\WPLib\Components\Google_Maps;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class TestModule
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\Integration
 * @coversDefaultClass Clubdeuce\WPLib\Components\Google_Maps
 * @group              Google_Maps
 * @group              Integration
 */
class TestGoogleMaps extends TestCase {

	/**
	 * @covers ::_wp_enqueue_scripts_9
	 */
	function testScriptRegistered() {
		$this->assertTrue(wp_script_is('google-maps', 'registered'));
		$this->assertTrue(wp_script_is('map-control', 'registered'));
	}

	/**
	 * @covers  ::_wp_enqueue_scripts_9
	 * @depends testScriptRegistered
	 */
	function testScriptEnqueued() {

		Google_Maps::register_script_condition(function(){return true;});

		$this->assertTrue(wp_script_is('google-maps', 'enqueued'));
		$this->assertTrue(wp_script_is('map-control', 'enqueued'));

	}
}