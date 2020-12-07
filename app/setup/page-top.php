<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.0.0
 */

use Framework\Helper;

add_action(
	'wp_enqueue_scripts',
	function() {
		if ( ! get_theme_mod( 'display-page-top' ) ) {
			return;
		}

		wp_enqueue_script(
			Helper::get_main_script_handle() . '-page-top',
			get_theme_file_uri( '/assets/js/page-top.js' ),
			[],
			filemtime( get_theme_file_path( '/assets/js/page-top.js' ) ),
			true
		);
	}
);
