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

Style::attach(
	Helper::get_main_style_handle() . '-snow-monkey-blocks',
	[
		[
			'selectors'  => '.smb-btn',
			'properties' => [ 'border-radius: 100% !important' ],
		],
	]
);

$accent_color = get_theme_mod( 'accent-color' );
if ( ! $accent_color ) {
	return;
}

$styles = [
	[
		'selectors'  => [ '.smb-btn' ],
		'properties' => [ 'background-color: ' . $accent_color ],
	],
	[
		'selectors'  => [ '.smb-btn-wrapper.is-style-ghost .smb-btn' ],
		'properties' => [
			'border-color: ' . $accent_color,
			'color: ' . $accent_color,
		],
	],
	[
		'selectors'  => [ '.smb-btn-wrapper.is-style-text .smb-btn' ],
		'properties' => [ 'color: ' . $accent_color ],
	],
];

Style::attach(
	Helper::get_main_style_handle() . '-snow-monkey-blocks',
	$styles
);
