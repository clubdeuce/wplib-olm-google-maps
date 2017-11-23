<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;
use Clubdeuce\WPGoogleMaps\Marker as WPMarker;

/**
 * Class Marker_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 *
 * @method \Clubdeuce\WPGoogleMaps\Marker marker()
 */
class Marker_Model extends Model_Base {

	/**
	 * @var WPMarker
	 */
    protected $_marker;

	/**
	 * @return bool
	 */
	function has_marker() {

		return $this->_has( '_marker' );

	}

	/**
	 * @return Location
	 */
	function location() {

		return new Location( array( 'location' => $this->marker()->location() ) );

	}

	/**
	 * @return Marker_Label
	 */
	function label() {

		return new Marker_Label( array( 'label' => $this->marker()->label() ) );

	}

	/**
	 * @return Info_Window
	 */
	function info_window() {

		$window = new Info_Window( array( 'info_window' => $this->marker()->info_window() ) );
		$window->set_position( array( 'lat' => $this->marker()->latitude(), 'lng' => $this->marker()->longitude()));

		return $window;

	}

	/**
	 * @param string $method_name
	 * @param array $args
	 *
	 * @return mixed|null
	 */
	function __call( $method_name, $args ) {

		do {
			$value = parent::__call( $method_name, $args );

			if ( $value ) {
				break;
			}

			if ( $this->has_marker() ) {
				$value = call_user_func_array( array( $this->marker(), $method_name ), $args );
				break;
			}
		} while ( false );

		return $value;

	}

}
