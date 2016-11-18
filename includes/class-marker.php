<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Marker
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 *
 * @property Marker_Model $model
 * @property Marker_View  $view
 * @mixin    Marker_Model
 * @mixin    Marker_View
 * @method   string label()
 * @method   float  latitude()
 * @method   float  longitude()
 * @method   string title
 */
class Marker extends \WPLib_Item_Base {

    /**
     * @return array
     */
    function make_options() {
        return array(
            'label' => $this->label(),
            'position' => array( 'lat' => $this->latitude(), 'lng' => $this->longitude() ),
            'title' => $this->title()
        );
    }
}