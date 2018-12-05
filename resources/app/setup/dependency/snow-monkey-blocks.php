<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

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
		$relative_path = '/assets/css/dependency/snow-monkey-blocks/style.min.css';
		$src  = get_theme_file_uri( $relative_path );
		$path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $path ) ) {
			return;
		}

		if ( is_admin() ) {
			$dependencies = [];
		} else {
			$dependencies = [ Helper\get_main_style_handle() ];
		}

		wp_enqueue_style(
			Helper\get_main_style_handle() . '-snow-monkey-blocks',
			$src,
			$dependencies,
			filemtime( $path )
		);
	}
);

/**
 * Enqueue Snow Monkey Blocks style in Gutenberg
 *
 * @return void
 */
add_action(
	'admin_enqueue_scripts',
	function( $hook_suffix ) {
		if ( ! Helper\is_block_editor() ) {
			return;
		}

		$relative_path = '/assets/css/dependency/snow-monkey-blocks/gutenberg.min.css';
		add_editor_style( [ $relative_path ] );
	}
);

/**
 * Load styles from customizer
 */
add_action(
	'snow_monkey_load_customizer_styles',
	function() {
		Helper\load_theme_files( get_template_directory() . '/assets/css/dependency/snow-monkey-blocks' );
	}
);
