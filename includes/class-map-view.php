<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Map_View
 * @package  Clubdeuce\GoogleMaps
 * @property Map $item
 * @method   Map_Model $model()
 */
class Map_View extends \WPLib_View_Base {

    function the_map() {

        $view = new \Clubdeuce\WPGoogleMaps\Map_View( $this->model() );

	    $view->the_map();

    }

}
