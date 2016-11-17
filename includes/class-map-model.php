<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Map_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Map_Model extends \WPLib_Model_Base {

    /**
     * @var array
     */
    protected $_center;

    /**
     * @var Marker[]
     */
    protected $_markers = array();

    /**
     * @var int
     */
    protected $_zoom = 5;

    /**
     * @param Marker $marker
     */
    function add_marker( $marker ) {

        $this->_markers[] = $marker;

    }

    /**
     * @param Marker[] $markers
     */
    function add_markers( $markers ) {

        $this->_markers = array_merge( $this->_markers, $markers );

    }

    /**
     * @return array
     */
    function center() {

        return $this->_center;

    }

    /**
     * @return Marker[]
     */
    function markers() {

        return $this->_markers;

    }

    /**
     * @return int
     */
    function zoom() {

        return $this->_zoom;

    }

}
