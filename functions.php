<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.3.2
 */

use Framework\Helper;

/**
 * Uses composer autoloader
 */
require_once get_template_directory() . '/vendor/autoload.php';

/**
 * Adjusted due to different directory structure in development and release
 */
spl_autoload_register(
	function ( $class_name ) {
		if ( 0 !== strpos( $class_name, 'Framework\\' ) ) {
			return;
		}

		$class_name = str_replace( '\\', '/', $class_name );
		$file       = get_template_directory() . '/' . $class_name . '.php';

		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
);

/**
 * Make theme available for translation
 */
add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain( 'snow-monkey', get_template_directory() . '/languages' );
	}
);

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
require_once __DIR__ . '/app/constructor/child-pages.php';
require_once __DIR__ . '/app/constructor/compatibility.php';
require_once __DIR__ . '/app/constructor/customizer.php';
require_once __DIR__ . '/app/constructor/design-skin.php';
require_once __DIR__ . '/app/constructor/detect-page-end.php';
require_once __DIR__ . '/app/constructor/detect-page-start.php';
require_once __DIR__ . '/app/constructor/manager.php';
require_once __DIR__ . '/app/constructor/oembed.php';
require_once __DIR__ . '/app/constructor/related-posts.php';
require_once __DIR__ . '/app/constructor/trial.php';
require_once __DIR__ . '/app/constructor/view-controller.php';
require_once __DIR__ . '/app/constructor/widgets.php';
require_once __DIR__ . '/app/constructor/deprecated/template-tags.php';

$updater_filepath = __DIR__ . '/app/constructor/updater.php';
if ( file_exists( $updater_filepath ) ) {
	include_once $updater_filepath;
}

/**
 * Change setup files loading method.
 *
 * @param string $type           Loading method type.
 * @param string $path           Full path of the file.
 * @param string $directory_slug Directory slug of the file.
 * @return string
 */
function snow_monkey_loading_method_callback( $type, $path, $directory_slug ) {
	$setup_files_loading_method = get_theme_mod( 'setup-files-loading-method' );
	$setup_files_loading_method = false === $setup_files_loading_method ? 'get_template_parts' : $setup_files_loading_method;
	if ( 'concat' === $setup_files_loading_method && 'app/widget' === $directory_slug ) {
		return $type;
	}
	return $setup_files_loading_method;
}
add_filter( 'snow_monkey_loading_method', 'snow_monkey_loading_method_callback', 10, 3 );

/**
 * If return false, do not expand get_template_part().
 * The various hooks that extend get_template_part added by this library will no longer be available.
 *
 * @return boolean
 */
add_filter(
	'inc2734_wp_view_controller_expand_get_template_part',
	function () {
		$expand_get_template_part = wp_cache_get( 'snow-monkey-expand-get-template-part' );
		if ( false === $expand_get_template_part ) {
			$expand_get_template_part = get_theme_mod( 'expand-get-template-part', true );
			wp_cache_set( 'snow-monkey-expand-get-template-part', $expand_get_template_part );
		}
		// Since the default value by WP Customizer Framework is not reflected here, it should be written in plain text.
		return $expand_get_template_part;
	},
	9
);

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
	function () {
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
