<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;
use Framework\Helper;

$styles = [];

if ( Helper::is_ie() ) {
	$accent_color = get_theme_mod( 'accent-color' );
	if ( $accent_color ) {
		$styles[] = [
			'selectors'  => [ '.wpaw-term' ],
			'properties' => [ 'background-color: ' . $accent_color ],
		];
	}
}

$terms = Helper::get_terms(
	[
		'taxonomy'   => 'category',
		'hide_empty' => false,
	]
);

foreach ( $terms as $_term ) {
	$accent_color = get_theme_mod( $_term->taxonomy . '-' . $_term->term_id . '-accent-color' );
	if ( ! $accent_color ) {
		continue;
	}

	$styles[] = [
		'selectors'  => [ '.wpaw-term.wpaw-term--category-' . $_term->term_id ],
		'properties' => [ 'background-color: ' . $accent_color ],
	];
}

if ( $styles ) {
	Style::attach(
		Helper::get_main_style_handle() . '-custom-widgets',
		$styles
	);
}
