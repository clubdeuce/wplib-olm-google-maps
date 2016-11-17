<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Map_View
 * @package  Clubdeuce\GoogleMaps
 * @property Map $item
 */
class Map_View extends \WPLib_View_Base {

    function the_map() {

        wp_localize_script( 'map-control', 'objMapParams',  $this->_make_map_args() );
        wp_localize_script( 'map-control', 'objMapMarkers', $this->_make_markers_args() );

        echo '<div id="map" class="google-map" style="height: 400px; width: 100%"></div>';

    }

    private function _make_map_args() {

        return array(
            'center' => $this->item->center(),
            'zoom'   => $this->item->zoom(),
        );

    }

    /**
     * @return array
     */
    private function _make_markers_args() {

        return array_map( array( __CLASS__, '_make_marker_args' ), $this->item->markers() );

    }

    /**
     * @param  Marker $marker
     * @return array
     */
    private function _make_marker_args( $marker ) {

        return array(
            'position' => array( 'lat' => $marker->latitude(), 'lng' => $marker->longitude() ),
            'title'    => $marker->title(),
        );

    }

}
