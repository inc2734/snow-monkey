<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Framework\Helper;

/**
* Uses composer autoloader
*/
require_once( get_template_directory() . '/vendor/autoload.php' );

/**
 * Adjusted due to different directory structure in development and release
 */
spl_autoload_register(
	function( $class ) {
		if ( 0 !== strpos( $class, 'Framework\\' ) ) {
			return;
		}

		$class = str_replace( '\\', '/', $class );
		$file  = get_template_directory() . '/' . $class . '.php';
		if ( file_exists( $file ) ) {
			require_once( $file );
		}
	}
);

/**
 * Make theme available for translation
 *
 * @return void
 */
load_theme_textdomain( 'snow-monkey', get_template_directory() . '/languages' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 */
global $content_width;
if ( ! isset( $content_width ) ) {
	$content_width = apply_filters( 'snow_monkey_content_width', 1220 );
}

/**
 * Loads theme constructer files
 */
Helper::include_files( untrailingslashit( __DIR__ ) . '/app/constructor', true );

/**
 * Loads theme setup files
 */
Helper::get_template_parts( untrailingslashit( __DIR__ ) . '/app/setup', true );

/**
 * Loads theme widget files
 */
Helper::get_template_parts( untrailingslashit( __DIR__ ) . '/app/widget', true );

/**
 * Loads customizer
 */
add_action(
	'init',
	function() {
		do_action( 'snow_monkey_pre_load_customizer' );
		foreach ( [ '/app/customizer' ] as $include ) {
			Helper::get_template_parts( untrailingslashit( __DIR__ ) . $include );
		}
		do_action( 'snow_monkey_post_load_customizer' );
	},
	10000
);
