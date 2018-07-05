<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Pure_CSS_Gallery\Pure_CSS_Gallery;

/**
 * Activate Pure CSS Gallery
 */
add_action( 'wp_loaded', function() {
	$use_pure_css_gallery = get_theme_mod( 'pure-css-gallery' );
	if ( ! $use_pure_css_gallery ) {
		return;
	}

	if ( has_filter( 'post_gallery' ) ) {
		return;
	}

	if ( class_exists( 'Jetpack' ) ) {
		$jetpack_active_modules = \Jetpack::get_active_modules();
		if ( in_array( 'carousel', $jetpack_active_modules ) || in_array( 'tiled-gallery', $jetpack_active_modules ) ) {
			return;
		}
	}

	new Pure_CSS_Gallery();
} );

/**
 * Load Pure CSS Gallery Scripts.
 * Not only galleries but also regular image links are converted.
 */
add_action( 'wp_enqueue_scripts', function() {
	$use_pure_css_gallery = get_theme_mod( 'pure-css-gallery' );
	if ( ! $use_pure_css_gallery ) {
		return;
	}

	$relative_path = '/assets/js/wp-pure-css-gallery.min.js';
	$src  = get_theme_file_uri( $relative_path );
	$path = get_theme_file_path( $relative_path );

	if ( ! file_exists( $path ) ) {
		return;
	}

	wp_enqueue_script(
		snow_monkey_get_main_script_handle() . '-wp-pure-css-gallery',
		$src,
		[ 'jquery' ],
		filemtime( $path ),
		true
	);

	$relative_path = '/assets/css/dependency/wp-pure-css-gallery/wp-pure-css-gallery.min.css';
	$src  = get_theme_file_uri( $relative_path );
	$path = get_theme_file_path( $relative_path );

	if ( ! file_exists( $path ) ) {
		return;
	}

	wp_enqueue_style(
		snow_monkey_get_main_script_handle() . '-wp-pure-css-gallery',
		$src,
		[],
		filemtime( $path )
	);
} );
