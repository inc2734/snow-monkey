<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 17.0.1
 */

use Framework\Helper;

if ( ! class_exists( 'WPCF7' ) ) {
	return;
}

/**
 * Enqueue Contact Form 7 style
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			Helper::get_main_style_handle() . '-wpcf7',
			get_theme_file_uri( '/assets/css/dependency/contact-form-7/app.css' ),
			[ Helper::get_main_style_handle() ],
			filemtime( get_theme_file_path( '/assets/css/dependency/contact-form-7/app.css' ) )
		);
	}
);
