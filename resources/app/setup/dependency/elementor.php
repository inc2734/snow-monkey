<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

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
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-elementor',
			get_theme_file_uri( $relative_path ),
			[ Helper::get_main_style_handle() ],
			filemtime( get_theme_file_path( $relative_path ) )
		);
	}
);

add_action(
	'elementor/preview/init',
	function() {
		$relative_path = '/assets/js/dependency/elementor/preview.min.js';
		wp_enqueue_script(
			Helper::get_main_style_handle() . '-elementor-preview',
			get_theme_file_uri( $relative_path ),
			[ 'wp-awesome-widgets' ],
			filemtime( get_theme_file_path( $relative_path ) )
		);
	}
);
