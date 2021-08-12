<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;
use Framework\Helper;

if ( Helper::is_ie() ) {
	$accent_color = get_theme_mod( 'accent-color' );
	if ( $accent_color ) {
		$styles = [
			[
				'selectors'  => [ '.c-entry-summary__term' ],
				'properties' => [ 'background-color: ' . $accent_color ],
			],
		];

		Style::attach(
			Helper::get_main_style_handle(),
			$styles
		);
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
		$ancestors = get_ancestors( $_term->term_id, $_term->taxonomy );
		foreach ( $ancestors as $ancestor ) {
			$accent_color = get_theme_mod( $_term->taxonomy . '-' . $ancestor . '-accent-color' );
			if ( ! $accent_color ) {
				continue;
			}
		}

		continue;
	}

	$styles = [
		[
			'selectors'  => [ '.c-entry-summary__term--' . $_term->taxonomy . '-' . $_term->term_id ],
			'properties' => [ 'background-color: ' . $accent_color ],
		],
	];

	Style::attach(
		Helper::get_main_style_handle(),
		$styles
	);
}
