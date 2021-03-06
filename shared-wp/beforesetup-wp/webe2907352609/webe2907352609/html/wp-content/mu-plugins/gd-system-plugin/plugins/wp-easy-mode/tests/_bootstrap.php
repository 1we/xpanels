<?php
use Codeception\Util\Debug;

$plugin_name = 'wp-easy-mode/wp-easy-mode.php';

// Activate our plugin if it's not already active.
//
// Note: Using a function_exists check too because it could
// be being loaded by the System Plugin behind the scenes.

if ( ! function_exists( 'wp_easy_mode' ) && ! is_plugin_active( $plugin_name ) ) {

	activate_plugin( $plugin_name );

}

if ( ! class_exists( 'WPEM_CLI' ) ) {

	WP_CLI::error( "WP_DEBUG must be set to TRUE in wp-config.php to run tests!" );

}

WP_CLI::launch_self( 'selenium start', [], [], false );

WP_CLI::line( 'Resetting WordPress ...' );

WP_CLI::launch_self( 'easy-mode reset', [], [ 'yes' => true ], false );
