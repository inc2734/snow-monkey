<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 16.0.0
 */

use Framework\Helper;

if ( ! defined( 'SNOW_MONKEY_FORMS_PATH' ) ) {
	return;
}

/**
 * Enqueue Snow Monkey Blocks style
 */
add_action(
	'enqueue_block_assets',
	function() {
		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-forms',
			false,
			[
				Helper::get_main_style_handle() . '-snow-monkey-forms-app',
				Helper::get_main_style_handle() . '-snow-monkey-forms-theme',
			]
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-forms-app',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-forms/app.css' ),
			[ 'snow-monkey-forms' ],
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-forms/app.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-forms-theme',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-forms/app-theme.css' ),
			[ Helper::get_main_style_handle() . '-snow-monkey-forms-app' ],
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-forms/app-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-snow-monkey-forms' );
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
						Helper::get_main_style_handle() . '-snow-monkey-forms-app',
						Helper::get_main_style_handle() . '-snow-monkey-forms-theme',
					]
				);
			}
		);
	}
);

/**
 * Use accent colors for buttons.
 */
add_filter(
	'render_block',
	function( $block_content, $block ) {
		if (
			'snow-monkey-forms/snow-monkey-form' !== $block['blockName']
			|| ! get_theme_mod( 'snow-monkey-forms-btn' )
		) {
			return $block_content;
		}

		return str_replace(
			'class="snow-monkey-form"',
			'class="snow-monkey-form snow-monkey-form--button-has-accent-color"',
			$block_content
		);
	},
	10,
	2
);
