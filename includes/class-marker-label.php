<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Marker_Label
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 * @property Marker_Label_Model $model
 * @property Marker_Label_View  $view
 * @mixin    Marker_Label_Model
 * @mixin    Marker_Label_View
 * @method   string       color()
 * @method   string|array options()
 * @method   string       font_family()
 * @method   string       font_size()
 * @method   string       font_weight()
 * @method   string       text()
 * @method   string       json_object()
 */
class Marker_Label extends \WPLib_Item_Base {

	/**
	 * Marker_Label constructor.
	 *
	 * @param array $args
	 */
	function __construct( $args = array() ) {

		$args = wp_parse_args( $args, array(
			'model' => new Marker_Label_Model( array( 'label' => new \Clubdeuce\WPGoogleMaps\Marker_Label( $args ) ) ),
		) );

		parent::__construct( $args );

	}

}