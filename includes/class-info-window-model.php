<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Info_Window_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 *
 * @method \Clubdeuce\WPGoogleMaps\Info_Window info_window()
 * @method string content()
 * @method int    pixel_offset()
 * @method array  position()
 * @method int    max_width()
 *
 * @mixin \Clubdeuce\WPGoogleMaps\Info_Window
 */
class Info_Window_Model extends Model_Base {

	/**
	 * @var \Clubdeuce\WPGoogleMaps\Info_Window
	 */
	protected $_info_window;

	/**
	 * Info_Window constructor.
	 *
	 * @param array $args
	 */
	function __construct( $args = array() ) {

		$args = wp_parse_args( $args, array(
			'info_window' => new \Clubdeuce\WPGoogleMaps\Info_Window( $args ),
		) );

		parent::__construct( $args );

	}

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
