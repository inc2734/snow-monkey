<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Core;

/**
* Uses composer autoloader
*/
require_once( get_theme_file_path( '/vendor/autoload.php' ) );

spl_autoload_register( function( $class ) {
	if ( 0 !== strpos( $class, 'Snow_Monkey' ) ) {
		return;
	}

	$class = str_replace( 'Snow_Monkey', '', $class );
	$class = str_replace( '\\', '/', $class );
	$class = str_replace( '_', '-', $class );
	$class = strtolower( $class );

	$class_path = get_theme_file_path( $class . '.php' );

	if ( ! file_exists( $class_path ) ) {
		return;
	}

	require $class_path;
} );

/**
 * Make theme available for translation
 *
 * @return void
 */
load_theme_textdomain( 'snow-monkey', get_template_directory() . '/languages' );

/**
 * Loads snow-monkey Bootstrap
 */
new Core();

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = apply_filters( 'snow_monkey_content_width', 1152 );
}

/**
 * Loads template tags
 */
$includes = [
	'/app/template-tags',
];
foreach ( $includes as $include ) {
	foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
		$template_name = str_replace( [ trailingslashit( __DIR__ ), '.php' ], '', $file );
		get_template_part( $template_name );
	}
}

/**
 * Loads theme setup files
 */
$includes = [
	'/app/setup',
	'/app/widget/*',
];
foreach ( $includes as $include ) {
	foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
		if ( 0 === strpos( basename( $file ), '_' ) ) {
			continue;
		}

		$template_name = str_replace( [ trailingslashit( __DIR__ ), '.php' ], '', $file );
		get_template_part( $template_name );
	}
}

/**
 * Loads customizer
 */
$includes = [
	'/app/customizer/*',
	'/app/customizer/*/sections/*',
	'/app/customizer/*/sections/*/controls',
	'/app/customizer/*/controls',
];
foreach ( $includes as $include ) {
	foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
		$template_name = str_replace( [ trailingslashit( __DIR__ ), '.php' ], '', $file );
		get_template_part( $template_name );
	}
}

/**
 * Output comment for get_template_part()
 */
if ( defined( 'WP_DEBUG' ) && WP_DEBUG && ! is_customize_preview() ) {
	$slugs = [];
	$files = snow_monkey_glob_recursive( get_template_directory() );
	if ( is_child_theme() ) {
		$files = array_merge( $files, snow_monkey_glob_recursive( get_stylesheet_directory() ) );
	}

	foreach ( $files as $file ) {
		$slug = str_replace( [ get_template_directory() . '/', get_stylesheet_directory() . '/', '.php' ], '', $file );
		$slugs[ $slug ] = $slug;
	}

	foreach ( $slugs as $slug ) {
		add_action( 'get_template_part_' . $slug, function( $slug, $name ) {
			if ( $name ) {
				$slug = $slug . '-' . $name;
			}

			printf( "\n" . '<!-- Start : %1$s -->' . "\n", esc_html( $slug ) );
		}, 10, 2 );
	}
}
