<?php
namespace Clubdeuce\WPLib\Components;


use Clubdeuce\WPLib\Components\GoogleMaps\Geocoder;
use Clubdeuce\WPLib\Components\GoogleMaps\Map;
use Clubdeuce\WPLib\Components\GoogleMaps\Marker;

class Google_Maps extends \WPLib_Module_Base {

    const INSTANCE_CLASS = 'Clubdeuce\WPLib\Components\GoogleMaps\Map';

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
        $source = home_url( '/vendor/clubdeuce/wplib-olm-google-maps/dist/scripts/maps.min.js' );

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            $source = home_url( '/vendor/clubdeuce/wplib-olm-google-maps/assets/maps.js' );
        }

        wp_register_script('google-maps', "https://maps.google.com/maps/api/js?v=3&key={$key}", false, '3.0', true );
        wp_register_script('map-control', $source, array( 'jquery', 'google-maps' ), '0.1.2', true );

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
