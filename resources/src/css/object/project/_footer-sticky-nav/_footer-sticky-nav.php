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
		'.p-footer-sticky-nav .c-navbar__item[class*="current_"] > a',
		'.p-footer-sticky-nav .c-navbar__item[class*="current-"] > a',
	],
	'color: ' . $accent_color
);

$cfs->register(
	[
		'.p-footer-sticky-nav .c-navbar__item:hover > a',
		'.p-footer-sticky-nav .c-navbar__item:active > a',
		'.p-footer-sticky-nav .c-navbar__item:focus > a',
	],
	'color: ' . $accent_color,
	'@media (min-width: 64em)'
);
