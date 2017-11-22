<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Marker_Label_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Marker_Label_Model extends Model_Base {

	/**
	 * @var \Clubdeuce\WPGoogleMaps\Marker_Label
	 */
	protected $_label;

	/**
	 * @return bool
	 */
	function has_label() {

		return $this->_has( '_label' );

	}

	/**
	 * @param  string $method_name
	 * @return mixed
	 */
	function __call( $method_name, $args ) {
		$value = null;

		do {

			if ( property_exists( $this, "_{$method_name}" ) ) {
				$property = "_{$method_name}";
				$value = $this->{$property};
				break;
			}

			if ( ! isset( $this->_label ) ) {
				break;
			}

			$value = call_user_func_array( array( $this->_label, $method_name ), $args );

		} while ( false );

		return $value;
	}

}
