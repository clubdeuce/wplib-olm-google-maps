<?php
namespace Clubdeuce\WPLib\Components;

require_once 'vendor/autoload.php';

use Clubdeuce\WPLib\Components\GoogleMaps\Geocoder;
use Clubdeuce\WPLib\Components\GoogleMaps\Map;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker;

class Google_Maps extends \WPLib_Module_Base {

    const INSTANCE_CLASS = 'Clubdeuce\WPLib\Components\GoogleMaps\Map';

	/**
	 * @var string
	 */
	protected static $_version = '0.1.6';

    /**
     * @var string
     */
    protected static $_api_key = '';

    /**
     * @var Geocoder
     */
    protected static $_geocoder;

    /**
     * These conditions will be used to determine whether to enqueue the Google Maps JS.
     *
     * @var array
     */
    protected static $_script_conditions = array();

    /**
     * The path to this module's directory
     *
     * @var string
     */
    protected static $_source_dir = '/vendor/clubdeuce/wplib-olm-google-maps';

    /**
     * The url to this module's directory
     *
     * @var string
     */
    protected static $_source_url;

    static function on_load() {

        self::add_class_action( 'wp_enqueue_scripts', 9 );

    }

    /**
     * @return string
     */
    static function api_key() {

        return static::$_api_key;

    }

    /**
     * @return Geocoder
     */
    static function geocoder() {

        if ( ! isset( static::$_geocoder ) ) {
            static::$_geocoder = new Geocoder( ['api_key' => self::api_key() ] );
        }

        return static::$_geocoder;

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
     * @param string $key
     */
    static function register_api_key( $key ) {

        static::$_api_key = filter_var( $key, FILTER_SANITIZE_STRING );

    }

    /**
     * @param callable $condition
     */
    static function register_script_condition( $condition ) {

        static::$_script_conditions[] = $condition;

    }

    static function _wp_enqueue_scripts_9() {

        $key = static::api_key();
        $source = sprintf( '%1$s/dist/scripts/maps.min.js', self::source_url() );

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            $source = sprintf( '%1$s/assets/maps.js', self::source_url() );
        }

        wp_register_script('google-maps', "https://maps.google.com/maps/api/js?v=3&key={$key}", false, '3.0', true );
        wp_register_script('map-control', $source, array( 'jquery', 'google-maps' ), self::version(), true );

        $conditions = array_map( array( __CLASS__, '_evaluate_condition' ), static::$_script_conditions );

        if ( in_array( true, $conditions ) ) {
            wp_enqueue_script( 'map-control' );
        }

    }

    static function script_conditions() {

        return static::$_script_conditions;

    }

    /**
     * @param  string $address
     * @param  array  $args
     * @return Marker
     */
    static function make_marker_by_address( $address, $args = array() ) {

        $args = wp_parse_args( $args, array(
            'address' => $address,
        ) );

        return new Marker( $args );

    }

    /**
     * @param  string $destination
     * @param  array  $args
     * @return string
     */
    static function driving_directions_href($destination, $args = array() ) {

        $args = wp_parse_args( $args, array(
            'start' => 'My Location',
        ) );

        return sprintf( 'https://maps.google.com/maps?saddr=%1$s&daddr=%2$s', urlencode( $args['start'] ), urlencode( $destination ) );
    }

    /**
     * @param string $path
     */
    static function register_source_dir( $path ) {

        if ( is_dir( $path ) ) {
            self::$_source_dir = $path;
        }

    }

    /**
     * @return string
     */
    static function source_dir() {

        return self::$_source_dir;

    }

    /**
     * @param $url
     */
    static function register_source_url( $url ) {

        self::$_source_url = $url;

    }

    /**
     * @return string
     */
    static function source_url() {

        $url = self::$_source_url;

        if ( is_ssl() ) {
            $url = preg_replace( '#^https*:\/\/([a-zA-z0-9\.]*)#', 'https://$1', $url );
        }

        return $url;

    }

    static function version() {

    	return self::$_version;

    }

    /**
     * @param  string|\Closure $callable
     * @return bool
     */
    private static function _evaluate_condition( $callable ) {

        $result = false;

        if ( is_callable( $callable ) ) {
            $result = call_user_func( $callable );
        }

        return $result;

    }

}

Google_Maps::on_load();
