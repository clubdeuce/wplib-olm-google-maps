<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Location
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 *
 * @property Location_Model $model
 * @property Location_View  $view
 * @mixin    Location_Model
 * @mixin    Location_View
 *
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
class Location extends \WPLib_Item_Base {

	function __construct( $args = array() ) {

		$args = wp_parse_args( $args, array(
			'location' => new \Clubdeuce\WPGoogleMaps\Location( $args ),
		) );

		parent::__construct( $args );


	}
}