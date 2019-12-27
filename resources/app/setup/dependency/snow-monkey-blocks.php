<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

use Framework\Helper;

if ( ! defined( 'SNOW_MONKEY_BLOCKS_DIR_PATH' ) ) {
	return;
}

add_filter( 'snow_monkey_blocks_pro', '__return_true' );

/**
 * Enqueue Snow Monkey Blocks style
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		if ( is_admin() ) {
			$dependencies = [];
		} else {
			$dependencies = [ Helper::get_main_style_handle() ];
		}

		wp_enqueue_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-blocks/style.min.css' ),
			$dependencies,
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-blocks/style.min.css' ) )
		);
	}
);

/**
 * Enqueue Snow Monkey Blocks style in the block editor
 *
 * @return void
 */
add_action(
	'after_setup_theme',
	function() {
		add_editor_style( [ '/assets/css/dependency/snow-monkey-blocks/editor-style.min.css' ] );
	}
);

/**
 * Load styles from customizer
 */
add_action(
	'inc2734_wp_customizer_framework_load_styles',
	function() {
		Helper::get_template_parts( get_template_directory() . '/assets/css/dependency/snow-monkey-blocks' );
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
				$styles = wp_styles();

				$block_handles = array_filter(
					$styles->queue,
					function( $handle ) {
						return 0 === strpos( $handle, 'snow-monkey-blocks/' );
					}
				);

				return array_merge(
					$handles,
					$block_handles,
					[
						'snow-monkey-blocks',
						Helper::get_main_style_handle() . '-snow-monkey-blocks',
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
		if ( ! get_theme_mod( 'js-loading-optimization' ) ) {
			return;
		}

		add_filter(
			'inc2734_wp_page_speed_optimization_defer_scripts',
			function( $handles ) {
				$styles = wp_scripts();

				$block_handles = array_filter(
					$styles->queue,
					function( $handle ) {
						return 0 === strpos( $handle, 'snow-monkey-blocks/' );
					}
				);

				return array_merge(
					$handles,
					$block_handles,
					[
						'snow-monkey-blocks',
					]
				);
			}
		);
	}
);
