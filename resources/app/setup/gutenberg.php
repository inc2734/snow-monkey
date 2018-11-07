<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'align-wide' );
	}
);

add_action(
	'enqueue_block_editor_assets',
	function() {
		gutenberg_override_style( 'wp-block-library-theme', null );
	}
);
