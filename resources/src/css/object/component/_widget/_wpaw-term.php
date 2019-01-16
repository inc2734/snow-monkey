<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

$accent_color = get_theme_mod( 'accent-color' );

Style::register(
	'.wpaw-term',
	'background-color: ' . $accent_color
);

$terms = get_terms( [ 'category' ] );
foreach ( $terms as $_term ) {
	$accent_color = get_theme_mod( $_term->taxonomy . '-' . $_term->term_id . '-accent-color' );
	if ( ! $accent_color ) {
		continue;
	}

	Style::register(
		'.wpaw-term--category-' . $_term->term_id,
		'background-color: ' . $accent_color
	);
}
