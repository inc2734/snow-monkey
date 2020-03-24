<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.3.4
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

/**
 * Load PHP files for styles
 *
 * @return void
 */
add_action(
	'inc2734_wp_customizer_framework_load_styles',
	function() {
		$includes = [
			'/assets/css/foundation',
			'/assets/css/object/component',
			'/assets/css/object/project',
			'/assets/css/custom-widgets',
		];
		foreach ( $includes as $include ) {
			Helper::get_template_parts( get_template_directory() . $include );
		}
	}
);

/**
 * Register styles for entry content.
 */
add_action(
	'inc2734_wp_customizer_framework_after_load_styles',
	function() {
		Style::placeholder(
			'entry-content',
			function( $selectors ) {
				$accent_color = get_theme_mod( 'accent-color' );

				$selectors_for_h2 = [];
				$selectors_for_th = [];

				foreach ( $selectors as $key => $selector ) {
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
						'border-right-color: ' . Color::light( $accent_color ),
						'border-left-color: ' . Color::light( $accent_color ),
					]
				);
			}
		);
	}
);
