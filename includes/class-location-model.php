<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Location_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 * @method  string address()
 * @method  string formatted_address()
 * @method  string state()
 * @method  string zip_code()
 * @method  float  latitude()
 * @method  string location_type()
 * @method  float  longitude()
 * @method  string place_id()
 * @method  array  type()
 * @method  array  viewport()
 */
class Location_Model extends \WPLib_Model_Base {

    /**
     * @var string
     */
    protected $_address;

    /**
     * @var string
     */
    protected $_formatted_address;

    /**
     * @var string
     */
    protected $_state;

    /**
     * @var string
     */
    protected $_zip_code;

    /**
     * @var float
     */
    protected $_latitude;

    /**
     * @var string
     */
    protected $_location_type;

    /**
     * @var float
     */
    protected $_longitude;

    /**
     * @var string
     */
    protected $_place_id;

    /**
     * @var array
     */
    protected $_viewport = array();

    /**
     * @param  string $method_name
     * @return mixed
     */
    public function __call( $method_name, $args ) {
        $value = null;

        if ( property_exists( $this, "_{$method_name}" ) ) {
            $property = "_{$method_name}";
            $value = $this->{$property};
        }

        return $value;
    }
}
