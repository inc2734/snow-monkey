<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\app\Helper;

if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
	return;
}

/**
 * Enqueue Elementor style
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		$relative_path = '/assets/css/dependency/elementor/elementor.min.css';
		$src  = get_theme_file_uri( $relative_path );
		$path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $path ) ) {
			return;
		}

		wp_enqueue_style(
			Helper::get_main_style_handle() . '-elementor',
			$src,
			[ Helper::get_main_style_handle() ],
			filemtime( $path )
		);
	}
);
