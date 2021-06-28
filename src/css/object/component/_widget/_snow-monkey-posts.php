<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

if ( ! Helper::is_ie() ) {
	return;
}

$accent_color = get_theme_mod( 'accent-color' );
if ( ! $accent_color ) {
	return;
}

$styles = [
	[
		'selectors'  => [ '.snow-monkey-posts__more' ],
		'properties' => [ 'background-color: ' . $accent_color ],
	],
	[
		'selectors'  => [ '.snow-monkey-posts__title::after' ],
		'properties' => [ 'background-color: ' . $accent_color ],
	],
];

Style::attach(
	Helper::get_main_style_handle(),
	$styles
);
