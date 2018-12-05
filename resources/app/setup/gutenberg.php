<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'align-wide' );
	}
);

add_action(
	'enqueue_block_editor_assets',
	function() {
		if ( function_exists( 'gutenberg_override_style' ) ) {
			gutenberg_override_style( 'wp-block-library-theme', null );
		} else {
			wp_deregister_style( 'wp-block-library-theme' );
			wp_register_style( 'wp-block-library-theme', null, [], 1 );
		}
	}
);
