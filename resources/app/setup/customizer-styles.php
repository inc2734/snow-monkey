<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Bootstrap;
use Inc2734\WP_Customizer_Framework\Style;

new Bootstrap();

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
add_action(
	'snow_monkey_load_customizer_styles',
	function() {
		Style::placeholder(
			'entry-content',
			function( $selector ) {
				var_dump( $selector );
				$accent_color = get_theme_mod( 'accent-color' );

				$selectors_for_h2 = [];
				$selectors_for_th = [];

				foreach ( $selector as $key => $selector ) {
					$selectors_for_h2[ $key ] = $selector . ' > h2';
					$selectors_for_th[ $key ] = $selector . ' > table thead th';
				}

				Style::register(
					$selectors_for_h2,
					'border-color: ' . $accent_color
				);

				Style::register(
					$selectors_for_th,
					[
						'background-color: ' . $accent_color,
						'border-right-color: ' . Style::light( $accent_color ),
						'border-left-color: ' . Style::light( $accent_color ),
					]
				);
			}
		);
	},
	12
);
