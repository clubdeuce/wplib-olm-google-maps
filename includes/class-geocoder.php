<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;
use Clubdeuce\WPLib\Components\Google_Maps;

/**
 * Class Geocoder
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Geocoder extends \Clubdeuce\WPGoogleMaps\Geocoder {

	/**
	 * @param string $address
	 *
	 * @return Location
	 */
	function geocode( $address ) {

		$geocoder = Google_Maps::geocoder();

		return new Location( array( 'location' => $geocoder->geocode( $address ) ) );

	}

}
