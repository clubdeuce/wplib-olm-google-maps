<?php
namespace Clubdeuce\WPLib\Components;

use Clubdeuce\WPLib\Components\GoogleMaps\Map;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker;

/**
 * Class Google_Maps
 * @package Clubdeuce\WPLib\Components
 *
 * @mixin \Clubdeuce\WPGoogleMaps\Google_Maps
 */
class Google_Maps extends \WPLib_Module_Base {

    const INSTANCE_CLASS = 'Clubdeuce\WPLib\Components\GoogleMaps\Map';

	/**
	 * @var string
	 */
	protected static $_version = '0.1.7';

	/**
	 *
	 */
    static function on_load() {

	    require_once 'vendor/autoload.php';
	    require_once 'includes/class-model-base.php';
        self::register_helper( '\Clubdeuce\WPGoogleMaps\Google_Maps', __CLASS__ );
	    \Clubdeuce\WPGoogleMaps\Google_Maps::initialize();

    }

    /**
     * @param  array $args
     * @return Map
     */
    static function make_new_map( $args = array() ) {

        $class = static::INSTANCE_CLASS;
        return new $class( $args );

    }

	/**
	 * @param $address
	 * @param array $args
	 *
	 * @return Marker
	 */
    static function make_marker_by_address( $address, $args = array() ) {

    	$marker = \Clubdeuce\WPGoogleMaps\Google_Maps::make_marker_by_address( $address, $args );
    	return new Marker( array_merge( array( 'marker' => $marker ), $args ) );

    }

	/**
	 * @param float  $lat
	 * @param float  $lng
	 * @param array  $args
	 *
	 * @return Marker
	 */
	static function make_marker_by_position( $lat, $lng, $args = array() ) {

		$marker = \Clubdeuce\WPGoogleMaps\Google_Maps::make_marker_by_position( $lat, $lng, $args );
		return new Marker( array_merge( array( 'marker' => $marker ), $args ) );

	}
}

Google_Maps::on_load();
