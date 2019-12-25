<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * This procceses are beta.
 */

use Inc2734\WP_Page_Speed_Optimization;
use Framework\Helper;

new WP_Page_Speed_Optimization\Bootstrap();

/**
 * Optimize the Snow Monkey JavaScript loading
 */
add_action(
	'after_setup_theme',
	function() {
		if ( ! get_theme_mod( 'js-loading-optimization' ) ) {
			return;
		}

		add_filter(
			'inc2734_wp_page_speed_optimization_defer_scripts',
			function( $handles ) {
				return array_merge(
					$handles,
					[
						'jquery.contents-outline',
						'slick-carousel',
						'wp-awesome-widgets',
						'wp-contents-outline',
						'wp-oembed-blog-card',
						'wp-pure-css-gallery',
						Helper::get_main_script_handle(),
						Helper::get_main_script_handle() . '-custom-widgets',
						Helper::get_main_script_handle() . '-drop-nav',
						Helper::get_main_script_handle() . '-fix-adminbar',
						Helper::get_main_script_handle() . '-footer-sticky-nav',
						Helper::get_main_script_handle() . '-global-nav',
						Helper::get_main_script_handle() . '-hash-nav',
						Helper::get_main_script_handle() . '-header',
						Helper::get_main_script_handle() . '-page-top',
						Helper::get_main_script_handle() . '-sidebar-sticky-widget-area',
						Helper::get_main_script_handle() . '-widgets',
					]
				);
			}
		);

		add_filter(
			'inc2734_wp_page_speed_optimization_async_scripts',
			function( $handles ) {
				return array_merge(
					$handles,
					[
						'comment-reply',
						'fontawesome5',
						'inc2734-wp-seo-google-analytics',
						'jquery.easing',
						'wp-embed',
						'wp-share-buttons',
						Helper::get_main_script_handle() . '-background-parallax-scroll',
						Helper::get_main_script_handle() . '-fontawesome',
						Helper::get_main_script_handle() . '-smooth-scroll',
					]
				);
			}
		);
	}
);

/**
 * Optimize the Snow Monkey JavaScript loading
 */
add_action(
	'after_setup_theme',
	function() {
		if ( ! get_theme_mod( 'jquery-loading-optimization' ) ) {
			return;
		}

		add_filter( 'inc2734_wp_page_speed_optimization_optimize_jquery_loading', '__return_true' );
	}
);

/**
 * Use HTTP2 Server Push
 */
add_action(
	'after_setup_theme',
	function() {
		if ( ! get_theme_mod( 'http2-server-push' ) ) {
			return;
		}

		add_filter( 'inc2734_wp_page_speed_optimization_do_http2_server_push', '__return_true' );
	}
);

/**
 * Output CSS in head
 */
add_action(
	'after_setup_theme',
	function() {
		if ( ! get_theme_mod( 'output-head-style' ) ) {
			return;
		}

		add_filter(
			'inc2734_wp_page_speed_optimization_output_head_styles',
			function( $handles ) {
				return array_merge(
					$handles,
					[
						'wp-block-library',
						Helper::get_main_style_handle(),
						'wp-pure-css-gallery',
						'wp-oembed-blog-card',
						'wp-share-buttons',
						'wp-like-me-box',
						'wp-awesome-widgets',
						'jquery.background-parallax-scroll',
						'slick-carousel',
						'slick-carousel-theme',
					]
				);
			}
		);
	}
);

/**
 * Caching nav menus
 */
add_action(
	'after_setup_theme',
	function() {
		if ( ! get_theme_mod( 'cache-nav-menus' ) ) {
			return;
		}

		add_filter( 'inc2734_wp_page_speed_optimization_caching_nav_menus', '__return_true' );
	}
);

/**
 * Async loading images
 */
add_action(
	'after_setup_theme',
	function() {
		if ( ! get_theme_mod( 'async-load-images' ) ) {
			return;
		}

		add_filter( 'inc2734_wp_page_speed_async_attachment_images', '__return_true' );
		add_filter( 'inc2734_wp_page_speed_async_content_images', '__return_true' );
	}
);

/**
 * Emoji assets move to footer
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_action( 'wp_footer', 'print_emoji_detection_script', 7 );
add_action( 'wp_footer', 'print_emoji_styles' );
