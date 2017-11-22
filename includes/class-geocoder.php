<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Geocoder
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Geocoder extends \Clubdeuce\WPGoogleMaps\Geocoder {

	/**
	 * @param string $address
	 *
	 * @return \Clubdeuce\WPGoogleMaps\Location|Location|\WP_Error
	 */
	function geocode( $address ) {

		$location = parent::geocode( $address );

		return new Location( array( 'location' => $location ) );

	}

}
