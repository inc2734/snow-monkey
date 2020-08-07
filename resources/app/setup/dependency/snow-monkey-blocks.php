<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
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
	'enqueue_block_assets',
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

		wp_enqueue_script(
			Helper::get_main_script_handle() . '-snow-monkey-blocks',
			get_theme_file_uri( '/assets/js/dependency/snow-monkey-blocks/app.min.js' ),
			[ 'snow-monkey-blocks/thumbnail-gallery' ],
			filemtime( get_theme_file_path( '/assets/js/dependency/snow-monkey-blocks/app.min.js' ) ),
			true
		);
	}
);

/**
 * Enqueue Snow Monkey Blocks style in the block editor
 *
 * @return void
 */
add_action(
	'enqueue_block_editor_assets',
	function() {
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks-editor',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-blocks/editor.min.css' ),
			[ Helper::get_main_style_handle() . '-snow-monkey-blocks' ],
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-blocks/editor.min.css' ) )
		);
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
