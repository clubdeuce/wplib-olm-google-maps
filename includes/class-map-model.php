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
     * The Map element height (default: 400px).
     * @var string
     */
    protected $_height = '400px';

    /**
     * The string to use for the map HTML element id property
     *
     * @var string
     */
    protected $_html_id;

    /**
     * @var Marker[]
     */
    protected $_markers = array();

    /**
     * The Map element width (default: 100%).
     * @var string
     */
    protected $_width = '100%';

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
     * @return string
     */
    function height() {

        return $this->_height;

    }

    /**
     * @return string
     */
    function html_id() {

        if ( ! isset( $this->_html_id ) ) {
            $this->_html_id = sprintf( 'map-%1$s', md5( serialize( array( $this->center(), $this->markers() ) ) ) );
        }

        return $this->_html_id;

    }

    /**
     * @return Marker[]
     */
    function markers() {

        return $this->_markers;

    }

    /**
     * @return string
     */
    function width() {

        return $this->_width;

    }

    /**
     * @return int
     */
    function zoom() {

        return $this->_zoom;

    }

	/**
	 * @return array
	 */
	function make_args() {

		return array(
			'center' => $this->center(),
			'zoom'   => (int)$this->zoom()
		);

	}

}
