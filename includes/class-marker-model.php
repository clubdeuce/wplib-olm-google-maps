<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Marker_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 *
 * @method  array latlng()
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
     * @var array
     */
    protected $_latlng;

    /**
     * @return array|\WP_Error
     */
    function latlng_object() {
        if (empty($this->_latlng)) {
            $this->_latlng   = $this->_geocoder()->geocode($this->_address);
        }
        
        return json_encode( $this->_latlng );
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
