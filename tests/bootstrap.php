<?php
define('SRC_DIR', dirname(__DIR__));
define('VENDOR_DIRECTORY', SRC_DIR . '/vendor');
define('TEST_INCLUDES_DIR', SRC_DIR . '/includes');

require_once getenv( 'WP_TESTS_DIR' ) . '/tests/phpunit/includes/functions.php';
require getenv( 'WP_TESTS_DIR' ) . '/tests/phpunit/includes/bootstrap.php';

require 'includes/testCase.php';

if ( ! function_exists( 'wplib_define' ) ) {
    require( VENDOR_DIRECTORY . '/wplib/wplib/defines.php' );
    wplib_define( 'WPLib_Runmode', 'PRODUCTION' );
    wplib_define( 'WPLib_Stability', 'EXPERIMENTAL' );
}
require_once VENDOR_DIRECTORY . '/autoload.php';
require_once VENDOR_DIRECTORY . '/wplib/wplib/wplib.php';

WPLib::initialize();

require_once SRC_DIR . '/component-google-maps.php';
require_once SRC_DIR . '/includes/class-model-base.php';
require_once SRC_DIR . '/includes/class-geocoder.php';
require_once SRC_DIR . '/includes/class-info-window.php';
require_once SRC_DIR . '/includes/class-info-window-model.php';
require_once SRC_DIR . '/includes/class-info-window-view.php';
require_once SRC_DIR . '/includes/class-location.php';
require_once SRC_DIR . '/includes/class-location-model.php';
require_once SRC_DIR . '/includes/class-location-view.php';
require_once SRC_DIR . '/includes/class-map.php';
require_once SRC_DIR . '/includes/class-map-model.php';
require_once SRC_DIR . '/includes/class-map-view.php';
require_once SRC_DIR . '/includes/class-marker.php';
require_once SRC_DIR . '/includes/class-marker-model.php';
require_once SRC_DIR . '/includes/class-marker-view.php';
require_once SRC_DIR . '/includes/class-marker-label.php';
require_once SRC_DIR . '/includes/class-marker-label-model.php';
require_once SRC_DIR . '/includes/class-marker-label-view.php';
