<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps\Tests;

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
}