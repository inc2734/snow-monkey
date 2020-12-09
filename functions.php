<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.0.0
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
include_once( __DIR__ . '/app/constructor/child-pages.php' );
include_once( __DIR__ . '/app/constructor/compatibility.php' );
include_once( __DIR__ . '/app/constructor/customizer.php' );
include_once( __DIR__ . '/app/constructor/design-skin.php' );
include_once( __DIR__ . '/app/constructor/detect-page-end.php' );
include_once( __DIR__ . '/app/constructor/detect-page-start.php' );
include_once( __DIR__ . '/app/constructor/oembed.php' );
include_once( __DIR__ . '/app/constructor/related-posts.php' );
include_once( __DIR__ . '/app/constructor/trial.php' );
include_once( __DIR__ . '/app/constructor/view-controller.php' );
include_once( __DIR__ . '/app/constructor/widgets.php' );
include_once( __DIR__ . '/app/constructor/deprecated/template-tags.php' );

$updater_filepath = __DIR__ . '/app/constructor/updater.php';
if ( file_exists( $updater_filepath ) ) {
	include_once( $updater_filepath );
}

/**
 * Loads theme setup files
 */
Helper::load_files( 'get_template_parts', __DIR__ . '/app/setup', true );

/**
 * Loads theme widget files
 */
Helper::load_files( 'get_template_parts', __DIR__ . '/app/widget', true );

/**
 * Loads customizer
 */
add_action(
	'init',
	function() {
		do_action( 'snow_monkey_pre_load_customizer' );

		Helper::load_files(
			'get_template_parts',
			__DIR__ . '/app/customizer',
			true
		);

		do_action( 'snow_monkey_post_load_customizer' );
	},
	10000
);
