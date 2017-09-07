<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$cfs = Customizer_Framework::styles();

$accent_color = get_theme_mod( 'accent-color' );

$cfs->register(
	[
		'.p-global-nav .c-navbar__item[class*="current_"] > a',
		'.p-global-nav .c-navbar__item[class*="current-"] > a',
	],
	"color: " . $accent_color
);

$cfs->register(
	[
		'.p-global-nav .c-navbar__item:hover > a',
		'.p-global-nav .c-navbar__item:active > a',
		'.p-global-nav .c-navbar__item:focus > a',
	],
	"color: " . $accent_color
);

$cfs->register(
	'.p-global-nav .c-navbar__item > .c-navbar__submenu::before',
	"border-bottom-color: " . $accent_color
);

$cfs->register(
	'.p-global-nav .c-navbar__submenu',
	"background-color: " . $accent_color
);
