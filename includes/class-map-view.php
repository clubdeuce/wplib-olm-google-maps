<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Map_View
 * @package  Clubdeuce\GoogleMaps
 * @property Map $item
 */
class Map_View extends \WPLib_View_Base {

    function the_map() {

        wp_localize_script( 'map-control', 'objMapParams',  $this->item->make_args() );
        wp_localize_script( 'map-control', 'objMapMarkers', $this->_make_markers_args() );

        echo '<div id="map" class="google-map" style="height: 400px; width: 100%"></div>';

    }

    /**
     * @return array
     */
    private function _make_markers_args() {

        /**
         * @var Marker $marker
         */
        return array_map( function( $marker ) {
            return $marker->make_options();
        }, $this->item->markers() );

    }

}
