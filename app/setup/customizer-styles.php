<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
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
			'/assets/css/layout',
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
				if ( ! Helper::is_ie() ) {
					return;
				}

				$accent_color = get_theme_mod( 'accent-color' );
				if ( ! $accent_color ) {
					return;
				}

				$selectors_for_h2       = [];
				$selectors_for_h3       = [];
				$selectors_for_thead_th = [];
				$selectors_for_tbody_th = [];

				foreach ( $selectors as $key => $selector ) {
					$selectors_for_h2[ $key ]       = $selector . ' > h2';
					$selectors_for_h3[ $key ]       = $selector . ' > h3';
					$selectors_for_thead_th[ $key ] = $selector . ' > table thead th';
					$selectors_for_tbody_th[ $key ] = $selector . ' > table tbody th';
				}

				// @see src/css/core/mixin/_entry-content.scss
				$h2_style = get_theme_mod( 'h2-style' );
				if ( $h2_style ) {
					if ( 'standard' === $h2_style ) {
						Style::register(
							$selectors_for_h2,
							[
								'border-left: 1px solid ' . $accent_color,
								'background-color: #f7f7f7',
								'padding: .44231rem .44231rem .44231rem .88462rem',
							]
						);
					}
				}

				// @see src/css/core/mixin/_entry-content.scss
				$h3_style = get_theme_mod( 'h3-style' );
				if ( $h3_style ) {
					if ( 'standard' === $h3_style ) {
						Style::register(
							$selectors_for_h3,
							[
								'border-bottom: 1px solid #eee',
								'padding: 0 0 .44231rem',
							]
						);
					}
				}

				Style::register(
					$selectors_for_thead_th,
					[
						'background-color: ' . $accent_color,
						'border-right-color: ' . Color::light( $accent_color ),
						'border-left-color: ' . Color::light( $accent_color ),
					]
				);

				Style::register(
					$selectors_for_tbody_th,
					'background-color: ' . Color::lightest( $accent_color )
				);
			}
		);
	}
);

/**
 * Register styles for widget title
 *
 * @see src/css/core/mixin/_entry-content.scss
 */
add_action(
	'inc2734_wp_customizer_framework_after_load_styles',
	function() {
		Style::placeholder(
			'widget-title',
			function( $selectors ) {
				if ( ! Helper::is_ie() ) {
					return;
				}

				$widget_title_style = get_theme_mod( 'widget-title-style' );
				if ( ! $widget_title_style ) {
					return;
				}

				if ( 'standard' !== $widget_title_style ) {
					return;
				}

				$selectors_for_title        = [];
				$selectors_for_title_pseudo = [];
				$selectors_for_title_before = [];
				$selectors_for_title_after  = [];

				foreach ( $selectors as $key => $selector ) {
					$selectors_for_title[ $key ]        = $selector;
					$selectors_for_title_pseudo[ $key ] = implode( ',', [ $selector . '::before', $selector . '::after' ] );
					$selectors_for_title_before[ $key ] = $selector . '::before';
					$selectors_for_title_after[ $key ]  = $selector . '::after';
				}

				Style::register(
					$selectors_for_title,
					[
						'display: flex',
						'flex-direction: row',
						'align-items: center',
						'justify-content: center',
					]
				);

				Style::register(
					$selectors_for_title_pseudo,
					[
						'display: block',
						'content: ""',
						'height: 1px',
						'background-color: #111',
						'flex: 1 0 0%',
						'min-width: 20px',
					]
				);

				Style::register(
					$selectors_for_title_before,
					[
						'margin-right: .5em',
					]
				);

				Style::register(
					$selectors_for_title_after,
					[
						'margin-left: .5em',
					]
				);
			}
		);
	}
);
