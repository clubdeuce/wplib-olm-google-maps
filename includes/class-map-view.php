<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Map_View
 * @package  Clubdeuce\GoogleMaps
 * @property Map $item
 */
class Map_View extends \WPLib_View_Base {

    function the_map() {

        $height       = $this->item->height();
        $width        = $this->item->width();
        $map_id       = $this->item->html_id();
        $map_params   = $this->item->make_args();
        $markers      = $this->_make_markers_args();
        $info_windows = $this->_make_info_windows();

        require dirname( __DIR__) . '/templates/map-view.php';

    }

    /**
     * @return array
     */
    protected function _make_markers_args() {

        return array_map( function( $marker ) {
            /**
             * @var Marker $marker
             */
            return $marker->marker_args();
        }, $this->item->markers() );

    }

    /**
     * @return array
     */
    protected function _make_info_windows() {

        $windows = array();

        /**
         * @var Marker $marker
         */
        foreach( $this->item->markers() as $marker ) {
            $info_window = $marker->info_window();
            $windows[]   = array(
                'content'      => $info_window->content(),
                'pixel_offset' => $info_window->pixel_offset(),
                'position'     => $info_window->position(),
                'max_width'    => $info_window->max_width(),
            );
        }

        return $windows;

    }
}
