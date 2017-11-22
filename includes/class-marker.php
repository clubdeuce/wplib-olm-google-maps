<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Marker
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 *
 * @property Marker_Model $model
 * @property Marker_View  $view
 * @mixin    Marker_Model
 * @mixin    Marker_View
 * @method   Marker_Label label()
 * @method   float        latitude()
 * @method   float        longitude()
 * @method   string       title()
 * @method   Info_Window  info_window()
 * @method   array        marker_args()
 * @method   Location     location()
 */
class Marker extends \WPLib_Item_Base {

	/**
	 * Marker_Model constructor.
	 *
	 * @param array $args
	 */
	function __construct( $args = array() ) {

		$args = wp_parse_args( $args, array(
			'model' => new Marker_Model( array( 'marker' => new \Clubdeuce\WPGoogleMaps\Marker( $args ) ) ),
		) );

		parent::__construct( $args );

	}


}
