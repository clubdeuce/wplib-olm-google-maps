<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests\UnitTests;

require_once dirname( dirname(__DIR__) ) . '/component-google-maps.php';

use Clubdeuce\WPLib\Components\Google_Maps;
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
     * @covers ::register_geocoder
     * @covers ::geocoder
     */
    public function testGeocoderSetAndGet() {

        $geocoder = \Mockery::mock('Clubdeuce\WPLib\Components\Google_Maps\Geocoder');

        Google_Maps::register_geocoder($geocoder);
        $this->assertEquals($geocoder, Google_Maps::geocoder());

    }

    /**
     * @covers ::make_new_map
     */
    public function testMakeNewMap() {

        $map = Google_Maps::make_new_map();

        $this->assertInstanceOf('Clubdeuce\WPLib\Components\GoogleMaps\Map', $map);

    }

}
