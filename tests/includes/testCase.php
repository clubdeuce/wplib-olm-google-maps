<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests;
use Mockery\Mock;

/**
 * Class TestCase
 * @package Clubdeuce\WPLib\Components\GoogleMaps\Tests
 */
class TestCase extends \WP_UnitTestCase {

    /**
     * @param $class
     * @param $property
     * @return mixed
     */
    public function getReflectionPropertyValue( $class, $property )
    {
        $reflection = new \ReflectionProperty( $class, $property );
        $reflection->setAccessible( true );
        return $reflection->getValue( $class );
    }

    /**
     * @param $class
     * @param $property
     * @param $value
     */
    public function setReflectionPropertyValue( $class, $property, $value )
    {
        $reflection = new \ReflectionProperty( $class, $property );
        $reflection->setAccessible( true );
        return $reflection->setValue( $class, $value );
    }

    /**
     * @param $class
     * @param $method
     * @return mixed
     */
    public function reflectionMethodInvoke( $class, $method )
    {
        $reflection = new \ReflectionMethod( $class, $method );
        $reflection->setAccessible( true );
        if (is_string($class)) {
            $class = null;
        }
        return $reflection->invoke( $class );
    }

    /**
     * @param $class
     * @param $method
     * @param $args
     * @return mixed
     */
    public function reflectionMethodInvokeArgs( $class, $method, $args )
    {
        $reflection = new \ReflectionMethod( $class, $method );
        $reflection->setAccessible( true );
        if (is_string($class)) {
            $class = null;
        }
        return $reflection->invoke( $class, $args );
    }

	/**
	 * @return string
	 */
    protected function get_sample_response() {

    	return file_get_contents( __DIR__ . '/geocoder-response.json' );

    }

	/**
	 * @return Mock
	 */
    protected function getMockGeocoder() {

	    /**
	     * @var Mock $geocoder
	     */
    	$geocoder = \Mockery::mock('\Clubdeuce\WPLib\Components\GoogleMaps\Geocoder');
	    $geocoder->shouldReceive('geocode')->andReturn($this->getMockLocation());

	    return $geocoder;
    }

	/**
	 * @return Mock
	 */
    protected function getMockLocation() {
	    /**
	     * @var Mock $location
	     */
    	$location = \Mockery::mock('\Clubdeuce\WPLib\Components\GoogleMape\Location');
	    $location->shouldReceive('address')->andReturn('1600 Amphitheatre Parkway, Mountain View, CA 94043, USA');
	    $location->shouldReceive('formatted_address')->andReturn('1600 Amphitheatre Parkway, Mountain View, CA 94043, USA');
	    $location->shouldReceive('state')->andReturn('CA');
	    $location->shouldReceive('zip_code')->andReturn('94043');
	    $location->shouldReceive('latitude')->andReturn(37.4224764);
	    $location->shouldReceive('longitude')->andReturn(-122.0842499);
	    $location->shouldReceive('place_id')->andReturn('ChIJ2eUgeAK6j4ARbn5u_wAGqWA');
	    $location->shouldReceive('type')->andReturn('street_address');
	    $location->shouldReceive('viewport')->andReturn(array(
	    	'northeast' => array(
			    'lat'   => 37.4238253802915,
			    'lng'   => -122.0829009197085
		    ),
		    'sourhwest' => array(
			    'lat'   => 37.4211274197085,
                'lng'   => -122.0855988802915
		    )
	    ));

	    return $location;
    }
}