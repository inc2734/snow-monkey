<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.7.1
 */

add_action(
	'customize_controls_enqueue_scripts',
	function() {
		wp_enqueue_script(
			get_template() . '-customize-control',
			get_theme_file_uri( '/assets/js/customize-control.min.js' ),
			[],
			filemtime( get_theme_file_path( '/assets/js/customize-control.min.js' ) ),
			true
		);
	}
);
