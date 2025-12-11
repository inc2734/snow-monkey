<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.10
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
	function () {
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
	function () {
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
	function () {
		if ( ! get_theme_mod( 'output-head-style' ) ) {
			return;
		}

		add_filter(
			'inc2734_wp_page_speed_optimization_output_head_styles',
			function ( $handles ) {
				return array_merge(
					$handles,
					array(
						'wp-block-library',
						Helper::get_main_style_handle(),
						Helper::get_main_style_handle() . '-app',
						Helper::get_main_style_handle() . '-theme',
						Helper::get_main_style_handle() . '-wpac',
						Helper::get_main_style_handle() . '-custom-widgets',
						Helper::get_main_style_handle() . '-custom-widgets-app',
						Helper::get_main_style_handle() . '-custom-widgets-theme',
						Helper::get_main_style_handle() . '-block-library',
						Helper::get_main_style_handle() . '-block-library-app',
						Helper::get_main_style_handle() . '-block-library-theme',
						'wp-pure-css-gallery',
						'wp-oembed-blog-card',
						'wp-share-buttons',
						'wp-like-me-box',
						'wp-awesome-widgets',
						'jquery.background-parallax-scroll',
						'slick-carousel',
						'slick-carousel-theme',
						'spider',
					)
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
	function () {
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
add_action(
	'after_setup_theme',
	function () {
		if ( get_theme_mod( 'disable-emoji' ) ) {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' ); // Less than 6.4.

			if ( function_exists( 'wp_enqueue_emoji_styles' ) ) {
				remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' ); // 6.4 or higher.
			}
		}
	}
);

/**
 * Caching template parts
 */
$cache_header       = get_theme_mod( 'cache-header' );
$cache_footer       = get_theme_mod( 'cache-footer' );
$cache_nav_menus    = get_theme_mod( 'cache-nav-menus' );
$cache_widget_areas = get_theme_mod( 'cache-widget-areas' );

$setup_files_loading_method = get_theme_mod( 'setup-files-loading-method' );
$setup_files_loading_method = false === $setup_files_loading_method ? 'get_template_parts' : $setup_files_loading_method;
$cache_setup_files          = 'concat' === $setup_files_loading_method;

if ( $cache_header || $cache_footer || $cache_nav_menus || $cache_widget_areas || $cache_setup_files ) {
	// If you cache and return HTML, it will not be parsed as a block.
	// When should_load_block_assets_on_demand is true,
	// assets are not loaded unless the block is parsed and its existence is confirmed,
	// which causes a malfunction.
	add_filter( 'should_load_block_assets_on_demand', '__return_false' );

	$template_cache = new Template_Cache();
	$remove_caches  = filter_input( INPUT_GET, 'sm-remove-caches' );

	if ( current_user_can( 'customize' ) ) {
		add_action(
			'admin_bar_menu',
			function ( $wp_admin_bar ) {
				$icon = Filesystem::get_contents( get_template_directory() . '/assets/img/icon.svg' );

				$wp_admin_bar->add_menu(
					array(
						'id'    => 'sm-remove-caches',
						'title' => sprintf(
							'%1$s%2$s',
							$icon,
							esc_html__( 'Remove caches', 'snow-monkey' )
						),
						'href'  => '?sm-remove-caches=1',
					)
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
				function (
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
						if ( file_exists( $template_cache->get_cache_filepath( 'header', $slug, $name, $vars ) ) ) {
							return $template_cache->get( 'header', $slug, $name, $vars );
						}
					}

					if ( $cache_footer && false !== strpos( $slug, 'templates/layout/footer' ) ) {
						if ( file_exists( $template_cache->get_cache_filepath( 'footer', $slug, $name, $vars ) ) ) {
							return $template_cache->get( 'footer', $slug, $name, $vars );
						}
					}

					if ( $cache_nav_menus && false !== strpos( $slug, 'template-parts/nav' ) ) {
						if ( file_exists( $template_cache->get_cache_filepath( 'nav', $slug, $name, $vars ) ) ) {
							return $template_cache->get( 'nav', $slug, $name, $vars );
						}
					}

					if ( $cache_widget_areas && false !== strpos( $slug, 'template-parts/widget-area' ) ) {
						if ( file_exists( $template_cache->get_cache_filepath( 'widget-area', $slug, $name, $vars ) ) ) {
							return $template_cache->get( 'widget-area', $slug, $name, $vars );
						}
					}

					return $html;
				},
				10000,
				4
			);

			add_filter(
				'snow_monkey_template_part_render',
				function (
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
						if ( ! file_exists( $template_cache->get_cache_filepath( 'header', $slug, $name, $vars ) ) ) {
							$template_cache->save( 'header', $html, $slug, $name, $vars );
						}
					}

					if ( $cache_footer && false !== strpos( $slug, 'templates/layout/footer' ) ) {
						if ( ! file_exists( $template_cache->get_cache_filepath( 'footer', $slug, $name, $vars ) ) ) {
							$template_cache->save( 'footer', $html, $slug, $name, $vars );
						}
					}

					if ( $cache_nav_menus && false !== strpos( $slug, 'template-parts/nav' ) ) {
						if ( ! file_exists( $template_cache->get_cache_filepath( 'nav', $slug, $name, $vars ) ) ) {
							$template_cache->save( 'nav', $html, $slug, $name, $vars );
						}
					}

					if ( $cache_widget_areas && false !== strpos( $slug, 'template-parts/widget-area' ) ) {
						if ( ! file_exists( $template_cache->get_cache_filepath( 'widget-area', $slug, $name, $vars ) ) ) {
							$template_cache->save( 'widget-area', $html, $slug, $name, $vars );
						}
					}

					return $html;
				},
				10000,
				4
			);
		}
	}
}
