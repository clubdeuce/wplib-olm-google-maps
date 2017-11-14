<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Marker_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Marker_Model extends \WPLib_Model_Base {

	/**
	 * @var \Clubdeuce\WPGoogleMaps\Marker
	 */
    protected $_marker;

	/**
	 * @return bool
	 */
	function has_marker() {

		$has = false;

		if ( isset( $this->_marker ) ) {
			$has = true;
		}

		return $has;

	}

	/**
	 * @param string $method_name
	 * @param array $arguments
	 *
	 * @return mixed|null
	 */
	function __call( $method_name, $arguments ) {

		$value = null;

		do {
			if ( property_exists( $this, "_{$method_name}" ) ) {
				$property = "_{$method_name}";
				$value = $this->{$property};
				break;
			}

			if ( $this->has_marker() ) {
				$value = call_user_func_array( array( $this->_marker, $method_name ), $arguments );
				break;
			}
		} while ( false );

		return $value;

	}

}
