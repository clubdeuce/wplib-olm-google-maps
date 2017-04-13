<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Marker_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Marker_Model extends \WPLib_Model_Base {

    /**
     * @var string
     */
    protected $_address;

    /**
     * @var Geocoder
     */
    protected $_geocoder;

    /**
     * @var Info_Window
     */
    protected $_info_window;

    /**
     * @var Marker_Label
     */
    protected $_label;

    /**
     * @var Location|\WP_Error
     */
    protected $_location;

    /**
     * @var string
     */
    protected $_title;

    /**
     * Marker_Model constructor.
     * @param array $args
     */
    function __construct( $args = array() ) {

        $args = wp_parse_args( $args, array(
            'address' => '',
            'info_window' => new Info_Window(),
            'label'   => new Marker_Label(),
            'title'   => '',
        ) );

        parent::__construct( $args );

    }

    /**
     * @return Info_Window
     */
    function info_window() {

        return $this->_info_window;

    }

    /**
     * @return Marker_Label
     */
    function label() {

        if ( is_string( $this->_label ) ) {
            $this->_label = new Marker_Label( array( 'text' => $this->label() ) );
        }

        return $this->_label;

    }

    /**
     * @return double
     */
    function latitude() {
        $latitude = 0;
        if ( ! is_wp_error( $this->location() ) ) {
            $latitude = $this->location()->latitude();
        }
        return $latitude;
    }

    /**
     * @return Location|\WP_Error
     */
    function location() {
        if ( ! is_object( $this->_location ) ) {
            $this->_location = $this->_geocoder()->geocode( $this->_address );
        }
        return $this->_location;
    }

    /**
     * @return double
     */
    function longitude() {
        $longitude = 0;
        if ( ! is_wp_error( $this->location() ) ) {
            $longitude = $this->location()->longitude();
        }
        return $longitude;
    }

    /**
     * Get the position of this marker. An array with key/value pairs of lat and lng.
     *
     * @return array
     */
    function position() {

        return array( 'lat' => $this->latitude(), 'lng' => $this->longitude() );

    }

    /**
     * @return string
     */
    function title() {
        return $this->_title;
    }

    /**
     * @param  array $args
     * @return array
     */
    function marker_args( $args = array() ) {

        $args = array_merge( $args, $this->extra_args );

        $args = wp_parse_args( $args, array(
            'position' => array( 'lat' => $this->latitude(), 'lng' => $this->longitude() ),
            'label'    => $this->label()->options(),
            'title'    => $this->title(),
        ) );

        return $args;

    }

    /**
     * @return Geocoder
     */
    private function _geocoder() {
        if (! is_object( $this->_geocoder ) ) {
            $this->_geocoder = new Geocoder();
        }

        return $this->_geocoder;
    }
}
