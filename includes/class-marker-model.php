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
     * @var Location
     */
    protected $_location;

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
            $this->_location = $this->_geocoder()->geocode($this->_address);
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
     * @return Geocoder
     */
    private function _geocoder() {
        if (! is_object($this->_geocoder)) {
            $this->_geocoder = new Geocoder();
        }

        return $this->_geocoder;
    }
}
