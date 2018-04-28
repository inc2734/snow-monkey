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

add_filter( 'inc2734_wp_page_speed_optimization_defer_scripts', function( $handles ) {
	return array_merge( $handles, [
		get_template(),
		get_stylesheet(),
	] );
} );

add_filter( 'inc2734_wp_page_speed_optimization_async_scripts', function( $handles ) {
	return array_merge( $handles, [
		'inc2734-wp-seo-google-analytics',
		'fontawesome5',
		'fontawesome5-v4-shims',
		'comment-reply',
		'wp-embed',
		'jquery.easing',
	] );
} );
