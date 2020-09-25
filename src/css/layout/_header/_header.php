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

Style::register(
	'.l-header',
	'color: ' . $header_text_color
);

Style::register(
	'.c-hamburger-btn__bar',
	'background-color: ' . $header_text_color
);

Style::register(
	[
		'.l-header--overlay-lg',
		'.l-header--sticky-overlay-lg',
		'[data-scrolled="false"] .l-header--sticky-overlay-colored-lg',
	],
	'color: ' . $overlay_header_text_color,
	'@media (min-width: 64em)'
);

Style::register(
	[
		'.l-header--overlay-sm',
		'.l-header--sticky-overlay-sm',
		'[data-scrolled="false"] .l-header--sticky-overlay-colored-sm',
	],
	'color: ' . $overlay_header_text_color,
	'@media (max-width: 63.9375em)'
);

Style::register(
	'.l-header__drop',
	'color: ' . $drop_nav_text_color
);
