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

$styles = [
	[
		'selectors'  => [ '.p-global-nav--hover-text-color .c-navbar__item[data-active-menu="true"]' ],
		'properties' => [ 'color: ' . $accent_color ],
	],
	[
		'selectors'   => [
			'.p-global-nav--hover-text-color .c-navbar__item:hover',
			'.p-global-nav--hover-text-color .c-navbar__item:active',
			'.p-global-nav--hover-text-color .c-navbar__item:focus',
		],
		'properties'  => [ 'color: ' . $accent_color ],
		'media_query' => '@media (min-width: 64em)',
	],
	[
		'selectors'  => [ '.p-global-nav--hover-underline .c-navbar__item[data-active-menu="true"]::after > a' ],
		'properties' => [ 'background-color: ' . $accent_color ],
	],
	[
		'selectors'   => [
			'.p-global-nav--hover-underline .c-navbar__item:hover::after > a',
			'.p-global-nav--hover-underline .c-navbar__item:active::after > a',
			'.p-global-nav--hover-underline .c-navbar__item:focus::after > a',
		],
		'properties'  => [ 'background-color: ' . $accent_color ],
		'media_query' => '@media (min-width: 64em)',
	],
	[
		'selectors'  => [ '.p-global-nav .c-navbar__item.sm-nav-menu-item-highlight' ],
		'properties' => [ 'background-color: ' . $accent_color ],
	],
	[
		'selectors'  => [ '.p-global-nav .c-navbar__item > .c-navbar__submenu::before' ],
		'properties' => [ 'border-bottom-color: ' . $accent_color ],
	],
	[
		'selectors'  => [ '.l-header--left .p-global-nav .c-navbar__item > .c-navbar__submenu::before' ],
		'properties' => [ 'border-right-color: ' . $accent_color ],
	],
	[
		'selectors'  => [ '.p-global-nav .c-navbar__submenu' ],
		'properties' => [ 'background-color: ' . $accent_color ],
	],
];

Style::attach(
	Helper::get_main_style_handle(),
	$styles
);

$sub_accent_color = get_theme_mod( 'sub-accent-color' );
if ( ! $sub_accent_color ) {
	return;
}

$styles = [
	[
		'selectors'  => [ '.p-global-nav .c-navbar__subitem.sm-nav-menu-item-highlight' ],
		'properties' => [ 'background-color: ' . $sub_accent_color ],
	],
];

Style::attach(
	Helper::get_main_style_handle(),
	$styles
);
