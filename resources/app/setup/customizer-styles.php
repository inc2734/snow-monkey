<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.0
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

/**
 * Load PHP files for styles
 *
 * @return void
 */
$hooks = [
	'wp_enqueue_scripts',
	'admin_enqueue_scripts',
];
foreach ( $hooks as $hook ) {
	add_action(
		$hook,
		function() use ( $hook ) {
			$includes = [
				'/assets/css/custom-widgets',
			];
			foreach ( $includes as $include ) {
				Helper::get_template_parts( get_template_directory() . $include );
			}

			global $editor_styles;

			$is_front = 'wp_enqueue_scripts' === $hook;
			$is_admin = 'admin_enqueue_scripts' === $hook;
			$is_style_front_registered = $is_front && wp_style_is( Helper::get_main_style_handle() . '-style', 'registered' );
			$is_style_admin_registered = $is_admin && in_array( 'assets/css/style/editor-style.min.css', $editor_styles );
			$is_theme_front_registered = $is_front && wp_style_is( Helper::get_main_style_handle() . '-theme', 'registered' );
			$is_theme_admin_registered = $is_admin && in_array( 'assets/css/theme/editor-theme.min.css', $editor_styles );

			if ( $is_style_front_registered || $is_style_admin_registered ) {
				$includes = [
					'/assets/css/style/foundation',
					'/assets/css/style/object/component',
					'/assets/css/style/object/project',
					'/assets/css/style/custom-widgets',
				];
				foreach ( $includes as $include ) {
					Helper::get_template_parts( get_template_directory() . $include );
				}
			}

			if ( $is_theme_front_registered || $is_theme_admin_registered ) {
				$includes = [
					'/assets/css/theme/foundation',
					'/assets/css/theme/object/component',
					'/assets/css/theme/object/project',
					'/assets/css/theme/custom-widgets',
				];
				foreach ( $includes as $include ) {
					Helper::get_template_parts( get_template_directory() . $include );
				}
			}

			Style::placeholder(
				'entry-content',
				function( $selectors ) {
					$accent_color = get_theme_mod( 'accent-color' );
					if ( ! $accent_color ) {
						return;
					}

					$selectors_for_th = [];

					foreach ( $selectors as $key => $selector ) {
						$selectors_for_th[ $key ] = $selector . ' > table thead th';
					}

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

			Style::placeholder(
				'theme-entry-content',
				function( $selectors ) {
					$accent_color = get_theme_mod( 'accent-color' );
					if ( ! $accent_color ) {
						return;
					}

					$selectors_for_h2 = [];

					foreach ( $selectors as $key => $selector ) {
						$selectors_for_h2[ $key ] = $selector . ' > h2';
					}

					Style::register(
						$selectors_for_h2,
						'border-color: ' . $accent_color
					);
				}
			);
		},
		12 // after enqueue main style
	);
}
