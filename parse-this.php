<?php
/**
 * Plugin Name: Parse This
 * Plugin URI: https://github.com/dshanske/parse-this
 * Description:
 * Version: 1.0
 * Author: David Shanske
 * Author URI: https://david.shanske.com
 * Text Domain: parse-this
 * Domain Path:  /languages
 */


/* Parse This Load
 */

if ( ! function_exists( 'parse_this_loader' ) ) {
	function parse_this_loader() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';
		// Parse This REST Endpoint
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-rest-parse-this.php';

	}
	add_action( 'plugins_loaded', 'parse_this_loader', 11 );
}

// autoloader
spl_autoload_register(
	function ( $class ) {
		$base_dir = __DIR__ . '/includes/';
		$bases = array( 'Parse_This', 'MF2' );
		foreach( $bases as $base ) {
			if ( strncmp( $class, $base, strlen( $base ) ) === 0 ) {
				$filename = 'class-' . strtolower( str_replace( '_', '-', $class ) );
				$file     = $base_dir . $filename . '.php';
				if ( file_exists( $file ) ) {
					require $file;
				}
			}
		}
	}
);
