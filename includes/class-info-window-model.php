<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Info_Window_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 *
 * @method \Clubdeuce\WPGoogleMaps\Info_Window info_window()
 */
class Info_Window_Model extends Model_Base {

	/**
	 * @var \Clubdeuce\WPGoogleMaps\Info_Window
	 */
	protected $_info_window;

	/**
	 * @return bool
	 */
	function has_info_window() {

		return $this->_has( '_info_window' );

	}

	/**
	 * @param string $method_name
	 * @param array $args
	 *
	 * @return mixed|null
	 */
	function __call( $method_name, $args ) {

		$value = null;

		do {
			$value = parent::__call( $method_name, $args );

			if ( $value ) {
				break;
			}

			if ( $this->has_info_window() ) {
				$value = call_user_func_array( array( $this->info_window(), $method_name ), $args );
				break;
			}
		} while ( false );

		return $value;

	}

}
