<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class InfoWindow
 * @package  Clubdeuce\WPLib\Components\GoogleMaps
 * @property Info_Window_Model $model
 * @property Info_Window_View  $view
 * @mixin    Info_Window_Model
 * @mixin    Info_Window_View
 *
 * @method   bool   has_info_window()
 * @method   string content()
 * @method   int    pixel_offset()
 * @method   array  position()
 * @method   int    max_width()
 * @method   void   set_content( $content )
 * @method   void   set_pixel_offset( $offset )
 * @method   void   set_position( $position )
 * @method   void   set_max_width( $max )
 *
 * @link     https://developers.google.com/maps/documentation/javascript/infowindows
 */
class Info_Window extends \WPLib_Item_Base {

}
