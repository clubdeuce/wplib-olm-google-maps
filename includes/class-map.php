<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Map
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 *
 * @property Map_Model $model
 * @property Map_View  $view
 * @mixin    Map_Model
 * @mixin    Map_View
 * @method   void     add_marker( $marker )
 * @method   void     add_markers( $markers )
 * @method   array    center()
 * @method   string   height()
 * @method   string   html_id()
 * @method   Marker[] markers()
 * @method   string   width()
 * @method   int      zoom()
 */
class Map extends \WPLib_Item_Base {

    /**
     * @return array
     */
    function make_args() {
        return array(
            'center' => $this->center(),
            'zoom'   => (int)$this->zoom(),
        );
    }
}