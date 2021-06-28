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

$header_text_color         = get_theme_mod( 'header-text-color' );
$overlay_header_text_color = '#fff';
$drop_nav_text_color       = '#333';

if ( ! $header_text_color ) {
	$header_text_color = '#333';
} else {
	$overlay_header_text_color = $header_text_color;
	$drop_nav_text_color       = $header_text_color;
}

$styles = [
	[
		'selectors'  => [ '.l-header' ],
		'properties' => [ 'color: ' . $header_text_color ],
	],
	[
		'selectors'  => [ '.c-hamburger-btn__bar' ],
		'properties' => [ 'background-color: ' . $header_text_color ],
	],
	[
		'selectors'   => [
			'.l-header--overlay-lg',
			'.l-header--sticky-overlay-lg',
			'[data-scrolled="false"] .l-header--sticky-overlay-colored-lg',
		],
		'properties'  => [ 'color: ' . $overlay_header_text_color ],
		'media_query' => '@media (min-width: 64em)',
	],
	[
		'selectors'   => [
			'.l-header--overlay-sm',
			'.l-header--sticky-overlay-sm',
			'[data-scrolled="false"] .l-header--sticky-overlay-colored-sm',
		],
		'properties'  => [ 'color: ' . $overlay_header_text_color ],
		'media_query' => '@media (min-width: 64em)',
	],
	[
		'selectors'  => [ '.l-header__drop' ],
		'properties' => [ 'color: ' . $drop_nav_text_color ],
	],
];

Style::attach(
	Helper::get_main_style_handle(),
	$styles
);
