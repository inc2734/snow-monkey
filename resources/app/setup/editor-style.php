<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Use main stylesheet for visual editor
 *
 * @return void
 */
add_action(
	'after_setup_theme',
	function() {
		add_editor_style(
			[
				'assets/css/editor-style.min.css',
			]
		);
	}
);

/**
 * Use main stylesheet for Gutenberg
 *
 * @return void
 */
add_action(
	'enqueue_block_editor_assets',
	function() {
		$relative_path = '/assets/css/gutenberg.min.css';
		$src  = get_theme_file_uri( $relative_path );
		$path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $path ) ) {
			return;
		}

		wp_enqueue_style(
			snow_monkey_get_main_style_handle(),
			$src,
			[],
			filemtime( $path )
		);
	}
);
