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

Style::register(
	[
		'.p-global-nav .c-navbar__item[data-active-menu="true"] > a',
	],
	'color: ' . $accent_color
);

Style::register(
	[
		'.p-global-nav .c-navbar__item:hover > a',
		'.p-global-nav .c-navbar__item:active > a',
		'.p-global-nav .c-navbar__item:focus > a',
	],
	'color: ' . $accent_color,
	'@media (min-width: 64em)'
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
