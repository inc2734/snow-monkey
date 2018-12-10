<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\app\Helper;

add_action(
	'wp_loaded',
	function() {
		do_action( 'snow_monkey_load_customizer_styles' );
	},
	11
);

add_action(
	'snow_monkey_load_customizer_styles',
	function() {
		$includes = [
			'/assets/css/foundation',
			'/assets/css/object/component',
			'/assets/css/object/project',
		];
		foreach ( $includes as $include ) {
			Helper::load_theme_files( get_template_directory() . $include );
		}
	}
);
