<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 16.0.0
 */

use Framework\Helper;

if ( ! defined( 'SNOW_MONKEY_BLOCKS_DIR_PATH' ) ) {
	return;
}

add_filter( 'snow_monkey_blocks_pro', '__return_true' );

/**
 * Enqueue Snow Monkey Blocks assets.
 */
add_action(
	'enqueue_block_assets',
	function() {
		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks',
			false,
			[
				Helper::get_main_style_handle() . '-snow-monkey-blocks-app',
				Helper::get_main_style_handle() . '-snow-monkey-blocks-theme',
			]
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks-app',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-blocks/app.css' ),
			[ 'snow-monkey-blocks' ],
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-blocks/app.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks-theme',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-blocks/app-theme.css' ),
			[ Helper::get_main_style_handle() . '-snow-monkey-blocks-app' ],
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-blocks/app-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-snow-monkey-blocks' );

		$dependencies = Helper::generate_script_dependencies(
			[
				'snow-monkey-blocks/spider-slider',
			]
		);

		wp_enqueue_script(
			Helper::get_main_script_handle() . '-snow-monkey-blocks',
			get_theme_file_uri( '/assets/js/dependency/snow-monkey-blocks/app.js' ),
			$dependencies,
			filemtime( get_theme_file_path( '/assets/js/dependency/snow-monkey-blocks/app.js' ) ),
			true
		);
	}
);

/**
 * Enqueue Snow Monkey Blocks style in the block editor.
 */
add_action(
	'enqueue_block_editor_assets',
	function() {
		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks/editor',
			false,
			[
				Helper::get_main_style_handle() . '-snow-monkey-blocks-app/editor',
				Helper::get_main_style_handle() . '-snow-monkey-blocks-theme/editor',
			]
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks-app/editor',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-blocks/editor.css' ),
			[
				Helper::get_main_style_handle() . '-snow-monkey-blocks-app',
			],
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-blocks/editor.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks-theme/editor',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-blocks/editor-theme.css' ),
			[
				Helper::get_main_style_handle() . '-snow-monkey-blocks-app/editor',
				Helper::get_main_style_handle() . '-snow-monkey-blocks-theme',
			],
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-blocks/editor-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-snow-monkey-blocks/editor' );
	}
);

/**
 * Load styles from customizer.
 */
add_action(
	'inc2734_wp_customizer_framework_load_styles',
	function() {
		Helper::load_files(
			'get_template_parts',
			get_template_directory() . '/assets/css/dependency/snow-monkey-blocks'
		);
	}
);

/**
 * Output CSS in head.
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
						return 0 === strpos( $handle, 'snow-monkey-blocks/' ) || 0 === strpos( $handle, 'snow-monkey-blocks-' );
					}
				);

				return array_merge(
					$handles,
					$block_handles,
					[
						'snow-monkey-blocks',
						Helper::get_main_style_handle() . '-snow-monkey-blocks',
						Helper::get_main_style_handle() . '-snow-monkey-blocks-app',
						Helper::get_main_style_handle() . '-snow-monkey-blocks-theme',
						'spider',
					]
				);
			}
		);
	}
);

/**
 * Register block styles.
 */
add_action(
	'init',
	function() {
		/**
		 * I really wanted to run it only when snow-monkey-blocks-theme is enqueued,
		 * but enqueue_block_editor_assets doesn't do it.
		 */
		$blocks = [
			'snow-monkey-blocks/section',
			'snow-monkey-blocks/section-with-bgimage',
			'snow-monkey-blocks/section-with-bgvideo',
			'snow-monkey-blocks/section-side-heading',
			'snow-monkey-blocks/section-break-the-grid',
		];
		foreach ( $blocks as $block ) {
			register_block_style(
				$block,
				[
					'name'  => 'smb-section-undecorated-title',
					'label' => __( 'Undecorated title', 'snow-monkey' ),
				]
			);
		}
	}
);
