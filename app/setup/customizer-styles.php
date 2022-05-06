<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 17.0.0
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

/**
 * Load PHP files for styles
 */
add_action(
	'inc2734_wp_customizer_framework_load_styles',
	function() {
		$includes = [
			'/assets/css/app',
			'/assets/css/block-library',
			'/assets/css/custom-widgets',
		];
		foreach ( $includes as $include ) {
			Helper::load_files( 'get_template_parts', get_template_directory() . $include );
		}
	}
);
