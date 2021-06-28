<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 *
 * This procceses are beta.
 */

use Inc2734\WP_Page_Speed_Optimization;
use Framework\Model\Template_Cache;
use Framework\Model\Filesystem;
use Framework\Helper;

new WP_Page_Speed_Optimization\Bootstrap();

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
						Helper::get_main_script_handle() . '-wpac',
						Helper::get_main_script_handle() . '-custom-widgets',
						Helper::get_main_script_handle() . '-block-library',
						'wp-pure-css-gallery',
						'wp-oembed-blog-card',
						'wp-share-buttons',
						'wp-like-me-box',
						'wp-awesome-widgets',
						'jquery.background-parallax-scroll',
						'slick-carousel',
						'slick-carousel-theme',
						'spider',
					]
				);
			}
		);
	}
);

/**
 * Link prefetching
 */
add_action(
	'after_setup_theme',
	function() {
		if ( ! get_theme_mod( 'use-link-prefetching' ) ) {
			return;
		}

		add_filter( 'inc2734_wp_page_speed_optimization_link_prefetching', '__return_true' );
	}
);

/**
 * Disable Emoji
 *
 * If you don't want to disable emoji, change to footer loading.
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
if ( ! get_theme_mod( 'disable-emoji' ) ) {
	add_action( 'wp_footer', 'print_emoji_detection_script', 7 );
	add_action( 'wp_footer', 'print_emoji_styles' );
}

/**
 * Caching template parts
 */
$cache_header       = get_theme_mod( 'cache-header' );
$cache_footer       = get_theme_mod( 'cache-footer' );
$cache_nav_menus    = get_theme_mod( 'cache-nav-menus' );
$cache_widget_areas = get_theme_mod( 'cache-widget-areas' );

if ( $cache_header || $cache_footer || $cache_nav_menus || $cache_widget_areas ) {
	$template_cache = new Template_Cache();
	$remove_caches  = filter_input( INPUT_GET, 'sm-remove-caches' );

	if ( current_user_can( 'administrator' ) ) {
		add_action(
			'admin_bar_menu',
			function( $wp_admin_bar ) {
				$icon = Filesystem::get_contents( get_template_directory() . '/assets/img/icon.svg' );

				$wp_admin_bar->add_menu(
					[
						'id'    => 'sm-remove-caches',
						'title' => sprintf(
							'%1$s%2$s',
							$icon,
							esc_html__( 'Remove caches', 'snow-monkey' )
						),
						'href'  => '?sm-remove-caches=1',
					]
				);
			},
			1000
		);

		if ( $remove_caches ) {
			$template_cache->remove();
		}
	}

	if ( ! is_customize_preview() ) {
		if ( ! $remove_caches ) {
			add_filter(
				'snow_monkey_pre_template_part_render',
				function(
					$html,
					$slug,
					$name,
					$vars
				) use (
					$cache_header,
					$cache_footer,
					$cache_nav_menus,
					$cache_widget_areas,
					$template_cache
				) {
					if ( $cache_header && false !== strpos( $slug, 'templates/layout/header' ) ) {
						return $template_cache->get( 'header', $slug, $name, $vars );
					}

					if ( $cache_footer && false !== strpos( $slug, 'templates/layout/footer' ) ) {
						return $template_cache->get( 'footer', $slug, $name, $vars );
					}

					if ( $cache_nav_menus && false !== strpos( $slug, 'template-parts/nav' ) ) {
						return $template_cache->get( 'nav', $slug, $name, $vars );
					}

					if ( $cache_widget_areas && false !== strpos( $slug, 'template-parts/widget-area' ) ) {
						return $template_cache->get( 'widget-area', $slug, $name, $vars );
					}

					return $html;
				},
				10,
				4
			);

			add_filter(
				'snow_monkey_template_part_render',
				function(
					$html,
					$slug,
					$name,
					$vars
				) use (
					$cache_header,
					$cache_footer,
					$cache_nav_menus,
					$cache_widget_areas,
					$template_cache
				) {
					if ( $cache_header && false !== strpos( $slug, 'templates/layout/header' ) ) {
						$template_cache->save( 'header', $html, $slug, $name, $vars );
					}

					if ( $cache_footer && false !== strpos( $slug, 'templates/layout/footer' ) ) {
						$template_cache->save( 'footer', $html, $slug, $name, $vars );
					}

					if ( $cache_nav_menus && false !== strpos( $slug, 'template-parts/nav' ) ) {
						$template_cache->save( 'nav', $html, $slug, $name, $vars );
					}

					if ( $cache_widget_areas && false !== strpos( $slug, 'template-parts/widget-area' ) ) {
						$template_cache->save( 'widget-area', $html, $slug, $name, $vars );
					}

					return $html;
				},
				10,
				4
			);
		}
	}
}
