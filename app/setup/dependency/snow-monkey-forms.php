<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.8.0
 */

use Framework\Helper;

if ( ! defined( 'SNOW_MONKEY_FORMS_PATH' ) ) {
	return;
}

/**
 * Enqueue Snow Monkey Blocks style
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-snow-monkey-forms',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-forms/style.min.css' ),
			[ 'snow-monkey-forms' ],
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-forms/style.min.css' ) )
		);
	}
);

add_action(
	'enqueue_block_editor_assets',
	function() {
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-snow-monkey-forms-editor',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-forms/editor.min.css' ),
			[ 'snow-monkey-forms@editor' ],
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-forms/editor.min.css' ) )
		);
	}
);

/**
 * Load styles from customizer
 */
add_action(
	'inc2734_wp_customizer_framework_load_styles',
	function() {
		Helper::load_files(
			'get_template_parts',
			get_template_directory() . '/assets/css/dependency/snow-monkey-forms'
		);
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
						return 0 === strpos( $handle, 'snow-monkey-forms/' );
					}
				);

				return array_merge(
					$handles,
					$block_handles,
					[
						'snow-monkey-forms',
						Helper::get_main_style_handle() . '-snow-monkey-forms',
					]
				);
			}
		);
	}
);
