<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Marker_Label_Model
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Marker_Label_Model extends \WPLib_Model_Base {

    /**
     * @var string
     */
    protected $_color = 'black';

    /**
     * @var null|string
     */
    protected $_font_family = null;

    /**
     * @var string
     */
    protected $_font_size = '14px';

    /**
     * @var string
     */
    protected $_font_weight = '400';

    /**
     * @var null|string
     */
    protected $_text = '';

    /**
     * @return string
     */
    function color() {

        return (string)$this->_color;

    }

    /**
     * @return null|string
     */
    function font_family() {

        return (string)$this->_font_family;

    }

    /**
     * @return string
     */
    function font_size() {

        return (string)$this->_font_size;

    }

    /**
     * @return string
     */
    function font_weight() {

        return (string)$this->_font_weight;

    }

    /**
     * @return null|string
     */
    function text() {

        return (string)$this->_text;

    }

    /**
     * @return string
     */
    function json_object() {

        return json_encode( $this->options() );

    }

    /**
     * @return string|array
     */
    function options() {

        $args = [
            'color'      => $this->color(),
            'fontFamily' => $this->font_family(),
            'fontSize'   => $this->font_size(),
            'fontWeight' => $this->font_weight(),
            'text'       => $this->text(),
        ];

        $args = array_filter( $args, function( $value ) {
            return ! is_null( $value );
        } );

        if ( empty( $args['text'] ) ) {
            $args = '';
        }

        return $args;

    }

}
