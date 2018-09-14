<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_action(
	'customize_controls_enqueue_scripts',
	function() {
		$relative_path = '/assets/js/customize-control.min.js';
		$src  = get_theme_file_uri( $relative_path );
		$path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $path ) ) {
			return;
		}

		wp_enqueue_script( get_template() . '-customize-preview', $src, [], filemtime( $path ), true );
	}
);
