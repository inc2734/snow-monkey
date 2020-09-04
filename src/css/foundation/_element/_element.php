<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

if ( Helper::is_ie() ) {
	$accent_color = get_theme_mod( 'accent-color' );
	if ( $accent_color ) {
		Style::register(
			'a',
			'color: ' . get_theme_mod( 'accent-color' )
		);
	}
}

Style::register(
	[
		'input[type="email"]',
		'input[type="number"]',
		'input[type="password"]',
		'input[type="search"]',
		'input[type="tel"]',
		'input[type="text"]',
		'input[type="url"]',
		'textarea',
	],
	'font-size: ' . get_theme_mod( 'base-font-size' ) . 'px'
);
