<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$cfs = Customizer_Framework::styles();

$accent_color = get_theme_mod( 'accent-color' );

$cfs->register(
	[
		'.c-entries--rich-media a > .c-entry-summary .c-entry-summary__figure::after',
		'.c-entries--rich-media a > .c-entry-summary .c-page-summary__figure::after',
	],
	[
		'background-color: ' . $cfs->rgba( $accent_color, .4 ),
		'background-image: radial-gradient(' . $cfs->rgba( $accent_color, .9 ) . ' 33%, transparent 33%)',
	]
);

$cfs->register(
	'.c-entry-summary__term',
	'background-color: ' . $accent_color
);

$terms = get_terms( [ 'category' ] );
foreach ( $terms as $_term ) {
	$accent_color = get_theme_mod( $_term->taxonomy . '-' . $_term->term_id . '-accent-color' );

	if ( ! $accent_color ) {
		$ancestors = get_ancestors( $_term->term_id, 'category' );
		foreach ( $ancestors as $ancestor ) {
			$accent_color = get_theme_mod( $_term->taxonomy . '-' . $ancestor . '-accent-color' );
			if ( ! $accent_color ) {
				continue;
			}
		}

		continue;
	}

	$cfs->register(
		'.c-entries--rich-media .c-entry-summary--' . $_term->taxonomy . '-' . $_term->term_id . ' .c-entry-summary__figure::after',
		[
			'background-color: ' . $cfs->rgba( $accent_color, .4 ),
			'background-image: radial-gradient(' . $cfs->rgba( $accent_color, .9 ) . ' 33%, transparent 33%)',
		]
	);

	$cfs->register(
		'.c-entry-summary--' . $_term->taxonomy . '-' . $_term->term_id . ' .c-entry-summary__term',
		'background-color: ' . $accent_color
	);
}
