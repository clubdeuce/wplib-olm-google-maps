<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;
use Clubdeuce\WPGoogleMaps\Map;


/**
 * Class Map_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 *
 * @mixin Map
 */
class Map_Model extends Model_Base {

	/**
	 * @var Map
	 */
	protected $_map;

	/**
	 * @return bool
	 */
	function has_map() {

		return $this->_has('_map' );

	}

	/**
	 * @param  string $method_name
	 * @param  array  $args
	 *
	 * @return mixed
	 */
	function __call( $method_name, $args = array() ) {
		$value = null;

		do {

			if ( property_exists( $this, "_{$method_name}" ) ) {
				$property = "_{$method_name}";
				$value = $this->{$property};
				break;
			}

			if ( ! isset( $this->_map ) ) {
				break;
			}

			$value = call_user_func_array( array( $this->_map, $method_name ), $args );

		} while ( false );

		return $value;
	}
}
