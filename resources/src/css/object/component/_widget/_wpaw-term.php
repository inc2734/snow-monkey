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

$terms = wp_cache_get( 'all-categories' );
if ( ! is_array( $terms ) ) {
	return;
}

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
