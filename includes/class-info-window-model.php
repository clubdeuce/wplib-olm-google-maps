<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Info_Window_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Info_Window_Model extends \WPLib_Model_Base {

    /**
     * @var string
     */
    protected $_content = '';

    /**
     * @var int
     */
    protected $_pixel_offset = 0;

    /**
     * @var array
     */
    protected $_position;

    /**
     * @var int
     */
    protected $_max_width;

    /**
     * @return string
     */
    function content() {

        return $this->_content;

    }

    /**
     * @return int
     */
    function pixel_offset() {

        return $this->_pixel_offset;

    }

    /**
     * @return array
     */
    function position() {

        return $this->_position;

    }

    /**
     * @return int
     */
    function max_width() {

        return $this->_max_width;

    }

}
