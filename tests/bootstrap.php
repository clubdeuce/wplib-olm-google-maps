<?php
define('SRC_DIR', dirname(__DIR__));
define('VENDOR_DIRECTORY', SRC_DIR . '/vendor');
define('TEST_INCLUDES_DIR', SRC_DIR . '/includes');

require_once getenv( 'WP_TESTS_DIR' ) . '/tests/phpunit/includes/functions.php';
require getenv( 'WP_TESTS_DIR' ) . '/tests/phpunit/includes/bootstrap.php';

require 'includes/testCase.php';

require VENDOR_DIRECTORY . '/autoload.php';

if ( ! function_exists( 'wplib_define' ) ) {
    require( VENDOR_DIRECTORY . '/wplib/wplib/defines.php' );
    wplib_define( 'WPLib_Runmode', 'PRODUCTION' );
    wplib_define( 'WPLib_Stability', 'EXPERIMENTAL' );
}

require VENDOR_DIRECTORY . '/wplib/wplib/wplib.php';
WPLib::initialize();

require_once dirname(__DIR__) . '/includes/class-geocoder.php';
require_once dirname(__DIR__) . '/includes/class-info-window-model.php';
require_once dirname(__DIR__) . '/includes/class-info-window-view.php';
require_once dirname(__DIR__) . '/includes/class-info-window.php';
require_once dirname(__DIR__) . '/includes/class-location.php';
require_once dirname(__DIR__) . '/includes/class-location-model.php';
require_once dirname(__DIR__) . '/includes/class-location-view.php';
require_once dirname(__DIR__) . '/includes/class-map.php';
require_once dirname(__DIR__) . '/includes/class-map-model.php';
require_once dirname(__DIR__) . '/includes/class-map-view.php';
require_once dirname(__DIR__) . '/includes/class-marker.php';
require_once dirname(__DIR__) . '/includes/class-marker-label.php';
require_once dirname(__DIR__) . '/includes/class-marker-label-model.php';
require_once dirname(__DIR__) . '/includes/class-marker-label-view.php';
require_once dirname(__DIR__) . '/includes/class-marker-model.php';
require_once dirname(__DIR__) . '/includes/class-marker-view.php';
require_once dirname(__DIR__) . '/component-google-maps.php';
