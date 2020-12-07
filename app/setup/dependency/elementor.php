<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.0.0
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
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-elementor',
			get_theme_file_uri( '/assets/css/dependency/elementor/elementor.min.css' ),
			[ Helper::get_main_style_handle() ],
			filemtime( get_theme_file_path( '/assets/css/dependency/elementor/elementor.min.css' ) )
		);
	}
);

add_action(
	'elementor/preview/init',
	function() {
		wp_enqueue_script(
			Helper::get_main_style_handle() . '-elementor-preview',
			get_theme_file_uri( '/assets/js/dependency/elementor/preview.js' ),
			[ 'jquery' ],
			filemtime( get_theme_file_path( '/assets/js/dependency/elementor/preview.js' ) )
		);
	}
);

add_action(
	'elementor/frontend/after_register_scripts',
	function() {
		wp_deregister_script( 'jquery-slick' );
	}
);
