<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

require_once dirname( dirname(__DIR__) ) . '/component-google-maps.php';

use Clubdeuce\WPLib\Components\Google_Maps;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker;
use Clubdeuce\WPLib\Components\GoogleMaps\Tests\TestCase;

/**
 * Class testGoogleMaps
 * @package            Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests
 * @coversDefaultClass Clubdeuce\WPLib\Components\Google_Maps
 */
class testGoogleMaps extends TestCase {

    /**
     * @covers ::register_api_key
     * @covers ::api_key
     */
    public function testApiKeySetAndGet() {

        Google_Maps::register_api_key('foo');
        $this->assertEquals('foo', Google_Maps::api_key());

    }

    /**
     * @covers ::geocoder
     */
    public function testGeocoder() {
        
        $this->assertInstanceOf('Clubdeuce\WPLib\Components\GoogleMaps\Geocoder', Google_Maps::geocoder());

    }

    /**
     * @covers ::make_new_map
     */
    public function testMakeNewMap() {

        $map = Google_Maps::make_new_map();

        $this->assertInstanceOf('Clubdeuce\WPLib\Components\GoogleMaps\Map', $map);

    }

    /**
     * @covers ::register_script_condition
     * @covers ::script_conditions
     */
    public function testRegisterScriptCondition() {

        Google_Maps::register_script_condition( 'is_search' );

        $conditions = Google_Maps::script_conditions();

        $this->assertInternalType('array', $conditions);
        $this->assertContains('is_search', $conditions);

    }

    /**
     * @covers ::make_marker_by_address
     */
    public function testMakeMarkerByAddress() {

        $marker = Google_Maps::make_marker_by_address('1600 Amphitheatre Way');

        $this->assertInstanceOf('\Clubdeuce\WPLib\Components\GoogleMaps\Marker', $marker);

    }

    /**
     * @covers ::driving_directions_href
     */
    public function testDrivingDirectionsHref() {

        $href = Google_Maps::driving_directions_href('1600 Amphitheatre Way');

        $this->assertRegExp('#^https:\/\/maps\.google\.com\/maps\?saddr=My\+Location&daddr=1600\+Amphitheatre\+Way#', $href);

    }

    /**
     * @covers ::driving_directions_href
     */
    public function testDrivingDirectionsWithStartAddress() {

        $href = Google_Maps::driving_directions_href('1600 Amphitheatre Way', array( 'start' => '1600 Pennsylvania Avenue'));

        $this->assertRegExp('#^https:\/\/maps\.google\.com\/maps\?saddr=1600\+Pennsylvania\+Avenue&daddr=1600\+Amphitheatre\+Way#', $href);

    }

    /**
     * @covers ::_evaluate_condition
     */
    public function testEvaluateCondition() {

        $this->assertTrue($this->reflectionMethodInvokeArgs('\Clubdeuce\WPLib\Components\Google_Maps', '_evaluate_condition', function(){return true;}));
        $this->assertFalse($this->reflectionMethodInvokeArgs('\Clubdeuce\WPLib\Components\Google_Maps', '_evaluate_condition', 'foo'));

    }

    /**
     * @covers ::_wp_enqueue_scripts_9
     */
    public function testWpEnqueueScripts9Register() {

        Google_Maps::_wp_enqueue_scripts_9();

        $this->assertTrue(wp_script_is('google-maps', 'registered'));
        $this->assertTrue(wp_script_is('map-control', 'registered'));
    }

    /**
     * @covers ::_wp_enqueue_scripts_9
     */
    public function testWpEnqueueScripts9Enqueue() {

        Google_Maps::register_script_condition(function(){return true;});
        Google_Maps::_wp_enqueue_scripts_9();

        $this->assertTrue(wp_script_is('jquery', 'enqueued'));
        $this->assertTrue(wp_script_is('google-maps', 'enqueued'));
        $this->assertTrue(wp_script_is('map-control', 'enqueued'));
    }
}
