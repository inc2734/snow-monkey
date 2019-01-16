<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Framework\Model\Styles;

/**
 * Output styles from PHP files
 *
 * @return void
 */
add_action(
	'wp_loaded',
	function() {
		do_action( 'snow_monkey_load_customizer_styles' );
	},
	11
);

/**
 * Load PHP files for styles
 *
 * @return void
 */
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

/**
 * Register styles for entry content.
 */
Styles::register(
	'entry-content',
	function( $selector ) {
		$accent_color = get_theme_mod( 'accent-color' );

		$cfs = \Inc2734\WP_Customizer_Framework\Customizer_Framework::styles();

		$selectors_for_h2 = [];
		$selectors_for_th = [];

		foreach ( $selector as $key => $selector ) {
			$selectors_for_h2[ $key ] = $selector . ' > h2';
			$selectors_for_th[ $key ] = $selector . ' > table thead th';
		}

		$cfs->register(
			$selectors_for_h2,
			'border-color: ' . $accent_color
		);

		$cfs->register(
			$selectors_for_th,
			[
				'background-color: ' . $accent_color,
				'border-right-color: ' . $cfs->light( $accent_color ),
				'border-left-color: ' . $cfs->light( $accent_color ),
			]
		);
	}
);
