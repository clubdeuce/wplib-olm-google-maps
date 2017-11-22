<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;
use Clubdeuce\WPGoogleMaps\Location;

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
class Location_Model extends Model_Base {

    /**
     * @var \Clubdeuce\WPGoogleMaps\Location
     */
    protected $_location;

	/**
	 * Location_Model constructor.
	 *
	 * @param array $args
	 */
	function __construct( $args = array() ) {

		$location = new Location( $args );

		$args = wp_parse_args( $args, array(
			'location' => $location,
		) );

		parent::__construct( $args );

	}

	/**
	 * @return bool
	 */
	function has_location() {

		return $this->_has( '_location' );

	}

    /**
     * @param  string $method_name
     * @return mixed
     */
    public function __call( $method_name, $args ) {
        $value = null;

	    do {

		    if ( property_exists( $this, "_{$method_name}" ) ) {
			    $property = "_{$method_name}";
			    $value = $this->{$property};
			    break;
		    }

		    if ( ! isset( $this->_location ) ) {
		    	break;
		    }

		    $value = call_user_func_array( array( $this->_location, $method_name ), $args );

	    } while ( false );

        return $value;
    }

}
