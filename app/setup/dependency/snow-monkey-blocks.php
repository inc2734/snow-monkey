<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
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
	function () {
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks',
			false,
			array(
				Helper::get_main_style_handle() . '-snow-monkey-blocks-app',
				Helper::get_main_style_handle() . '-snow-monkey-blocks-theme',
			)
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks-app',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-blocks/app.css' ),
			array( 'snow-monkey-blocks' ),
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-blocks/app.css' ) )
		);

		wp_register_style(
			Helper::get_main_style_handle() . '-snow-monkey-blocks-theme',
			get_theme_file_uri( '/assets/css/dependency/snow-monkey-blocks/app-theme.css' ),
			array( Helper::get_main_style_handle() . '-snow-monkey-blocks-app' ),
			filemtime( get_theme_file_path( '/assets/css/dependency/snow-monkey-blocks/app-theme.css' ) )
		);

		wp_enqueue_style( Helper::get_main_style_handle() . '-snow-monkey-blocks' );

		$dependencies = Helper::generate_script_dependencies(
			array(
				'snow-monkey-blocks/spider-slider',
			)
		);

		wp_enqueue_script(
			Helper::get_main_script_handle() . '-snow-monkey-blocks',
			get_theme_file_uri( '/assets/js/dependency/snow-monkey-blocks/app.js' ),
			$dependencies,
			filemtime( get_theme_file_path( '/assets/js/dependency/snow-monkey-blocks/app.js' ) ),
			array(
				'strategy'  => 'defer',
				'in_footer' => false,
			)
		);
	}
);

/**
 * Output CSS in head.
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
				$styles = wp_styles();

				$block_handles = array_filter(
					$styles->queue,
					function ( $handle ) {
						return 0 === strpos( $handle, 'snow-monkey-blocks/' ) || 0 === strpos( $handle, 'snow-monkey-blocks-' );
					}
				);

				return array_merge(
					$handles,
					$block_handles,
					array(
						'snow-monkey-blocks',
						Helper::get_main_style_handle() . '-snow-monkey-blocks',
						Helper::get_main_style_handle() . '-snow-monkey-blocks-app',
						Helper::get_main_style_handle() . '-snow-monkey-blocks-theme',
						'spider',
					)
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
	function () {
		/**
		 * I really wanted to run it only when snow-monkey-blocks-theme is enqueued,
		 * but enqueue_block_editor_assets doesn't do it.
		 */
		$blocks = array(
			'snow-monkey-blocks/section',
			'snow-monkey-blocks/section-with-bgimage',
			'snow-monkey-blocks/section-with-bgvideo',
			'snow-monkey-blocks/section-side-heading',
			'snow-monkey-blocks/section-break-the-grid',
		);
		foreach ( $blocks as $block ) {
			register_block_style(
				$block,
				array(
					'name'  => 'smb-section-undecorated-title',
					'label' => __( 'Undecorated title', 'snow-monkey' ),
				)
			);
		}
	}
);
