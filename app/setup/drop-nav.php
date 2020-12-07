<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.0.0
 */

use Framework\Helper;

/**
 * Enqueue scripts
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_register_script(
			Helper::get_main_script_handle() . '-drop-nav',
			get_theme_file_uri( '/assets/js/drop-nav.js' ),
			[],
			filemtime( get_theme_file_path( '/assets/js/drop-nav.js' ) ),
			true
		);

		if ( Helper::has_drop_nav() ) {
			wp_enqueue_script( Helper::get_main_script_handle() . '-drop-nav' );
		}
	}
);
