<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

if ( ! Helper::is_ie() ) {
	return;
}

$accent_color = get_theme_mod( 'accent-color' );
if ( ! $accent_color ) {
	return;
}

$styles = [
	[
		'selectors'  => [ '.wpaw-pr-box__title::after' ],
		'properties' => [ 'background-color: ' . $accent_color ],
	],
];

Style::attach(
	Helper::get_main_style_handle() . '-custom-widgets',
	$styles
);
