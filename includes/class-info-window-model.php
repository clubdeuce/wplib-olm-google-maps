<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Info_Window_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Info_Window_Model extends \WPLib_Model_Base {

	/**
	 * @var \Clubdeuce\WPGoogleMaps\Info_Window
	 */
	protected $_info_window;

	function __construct( $args = array() ) {

		$args = wp_parse_args( $args, array(
			'info_window' => new \Clubdeuce\WPGoogleMaps\Info_Window( $args ),
		) );

		parent::__construct( $args );

	}

}
