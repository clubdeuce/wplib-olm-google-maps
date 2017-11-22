<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

if ( ! class_exists( 'Clubdeuce\WPLib\Components\GoogleMaps\Model_Base' ) ):
/**
 * Class Model_Base
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Model_Base extends \WPLib_Model_Base {

	/**
	 * @param $property
	 *
	 * @return bool
	 */
	protected function _has( $property ) {

		$has = false;

		if ( isset( $this->{$property} ) ) {
			$has = true;
		}

		return $has;

	}

	/**
	 * @param string $method_name
	 * @param array $args
	 *
	 * @return null
	 */
	function __call( $method_name, $args ) {

		$value = null;

		if ( property_exists( $this, "_{$method_name}" ) ) {
			$property = "_{$method_name}";
			$value = $this->{$property};

		}

		return $value;

	}

}
endif;