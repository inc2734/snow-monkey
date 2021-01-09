<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Color;
use Inc2734\WP_Customizer_Framework\Style;

if ( ! Helper::is_ie() ) {
	return;
}

$accent_color = get_theme_mod( 'accent-color' );
if ( ! $accent_color ) {
	return;
}

Style::register(
	'.p-global-nav--hover-text-color .c-navbar__item[data-active-menu="true"]',
	'color: ' . $accent_color
);

Style::register(
	[
		'.p-global-nav--hover-text-color .c-navbar__item:hover',
		'.p-global-nav--hover-text-color .c-navbar__item:active',
		'.p-global-nav--hover-text-color .c-navbar__item:focus',
	],
	'color: ' . $accent_color,
	'@media (min-width: 64em)'
);

Style::register(
	'.p-global-nav--hover-underline .c-navbar__item[data-active-menu="true"]::after > a',
	'background-color: ' . $accent_color
);

Style::register(
	[
		'.p-global-nav--hover-underline .c-navbar__item:hover::after > a',
		'.p-global-nav--hover-underline .c-navbar__item:active::after > a',
		'.p-global-nav--hover-underline .c-navbar__item:focus::after > a',
	],
	'background-color: ' . $accent_color,
	'@media (min-width: 64em)'
);

Style::register(
	'.p-global-nav .c-navbar__item.sm-nav-menu-item-highlight',
	'background-color: ' . $accent_color
);

Style::register(
	'.p-global-nav .c-navbar__item > .c-navbar__submenu::before',
	'border-bottom-color: ' . $accent_color
);

Style::register(
	'.l-header--left .p-global-nav .c-navbar__item > .c-navbar__submenu::before',
	'border-right-color: ' . $accent_color
);

Style::register(
	'.p-global-nav .c-navbar__submenu',
	'background-color: ' . $accent_color
);

$sub_accent_color = get_theme_mod( 'sub-accent-color' );
if ( ! $sub_accent_color ) {
	return;
}

Style::register(
	'.p-global-nav .c-navbar__subitem.sm-nav-menu-item-highlight',
	'background-color: ' . $sub_accent_color
);
