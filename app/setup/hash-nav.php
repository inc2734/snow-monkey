<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.0.0
 */

use Framework\Helper;

add_action(
	'wp_footer',
	function() {
		Helper::get_template_part( 'template-parts/common/overlay-search-box' );

		if ( Helper::is_active_sidebar( 'overlay-widget-area' ) ) {
			Helper::get_template_part( 'template-parts/widget-area/overlay' );
		}
	}
);

add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_script(
			Helper::get_main_script_handle() . '-hash-nav',
			get_theme_file_uri( '/assets/js/hash-nav.js' ),
			[],
			filemtime( get_theme_file_path( '/assets/js/hash-nav.js' ) ),
			true
		);
	}
);
