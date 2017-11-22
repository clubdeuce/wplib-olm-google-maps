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

\Clubdeuce\WPLib\Components\Google_Maps::initialize();
