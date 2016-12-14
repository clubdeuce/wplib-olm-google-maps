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
     * @var string
     */
    protected $_label;

    /**
     * @var Location
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
            'label'   => null,
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
     * @return string
     */
    function label() {
        return $this->_label;
    }

    /**
     * @return float
     */
    function latitude() {
        return $this->location()->latitude();
    }

    /**
     * @return Location
     */
    function location() {
        if ( ! is_object( $this->_location ) ) {
            $this->_location = $this->_geocoder()->geocode( $this->_address );
        }
        return $this->_location;
    }

    /**
     * @return float
     */
    function longitude() {
        return $this->location()->longitude();
    }

    /**
     * @return string
     */
    function title() {
        return $this->_title;
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
