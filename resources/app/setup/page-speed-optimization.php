<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 *
 * This procceses are beta.
 */

use Inc2734\WP_Page_Speed_Optimization\Page_Speed_Optimization;

new Page_Speed_Optimization();

/**
 * Optimize the Snow Monkey JavaScript loading
 */
add_action( 'after_setup_theme', function() {
	if ( ! get_theme_mod( 'js-loading-optimization' ) ) {
		return;
	}

	add_filter( 'inc2734_wp_page_speed_optimization_defer_scripts', function( $handles ) {
		return array_merge( $handles, [
			get_template(),
			get_stylesheet(),
		] );
	} );

	add_filter( 'inc2734_wp_page_speed_optimization_async_scripts', function( $handles ) {
		return array_merge( $handles, [
			'inc2734-wp-seo-google-analytics',
		] );
	} );

	add_filter( 'inc2734_wp_page_speed_optimization_builded_scripts', function( $handles ) {
		return array_merge( $handles, [
			'fontawesome5',
			'fontawesome5-v4-shims',
			'comment-reply',
			'wp-embed',
			'jquery.easing',
		] );
	} );
} );

/**
 * Use HTTP2 Server Push
 */
add_action( 'after_setup_theme', function() {
	if ( ! get_theme_mod( 'http2-server-push' ) ) {
		return;
	}

	add_filter( 'inc2734_wp_page_speed_optimization_do_http2_server_push', '__return_true' );
} );

/**
 * Loads CSS asynchronously
 */
add_action( 'after_setup_theme', function() {
	if ( ! get_theme_mod( 'async-css' ) ) {
		return;
	}

	add_action( 'wp_head', function() {
		?>
		<style>body{visibility:hidden;}.js-bg-parallax{transition: none !important;}</style>
		<?php
	} );

	add_filter( 'inc2734_wp_page_speed_optimization_do_preload_stylesheet', '__return_true' );
} );

/**
 * Output CSS in head
 */
add_action( 'after_setup_theme', function() {
	if ( ! get_theme_mod( 'output-head-style' ) ) {
		return;
	}

	add_filter( 'inc2734_wp_page_speed_optimization_output_head_style', '__return_true' );
} );

/**
 * Emoji assets move to footer
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_action( 'wp_footer', 'print_emoji_detection_script', 7 );
add_action( 'wp_footer', 'print_emoji_styles' );
