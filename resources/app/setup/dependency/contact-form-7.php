<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

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
		$relative_path = '/assets/css/dependency/contact-form-7/wpcf7.min.css';
		$src  = get_theme_file_uri( $relative_path );
		$path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $path ) ) {
			return;
		}

		wp_enqueue_style(
			Helper\get_main_style_handle() . '-wpcf7',
			$src,
			[ Helper\get_main_style_handle() ],
			filemtime( $path )
		);
	}
);

add_action(
	'wp_loaded',
	function() {
		Helper\get_template_parts( get_template_directory() . '/assets/css/dependency/contact-form-7' );
	},
	11
);
