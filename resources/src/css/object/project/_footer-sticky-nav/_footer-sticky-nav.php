<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

$accent_color = get_theme_mod( 'accent-color' );
if ( ! $accent_color ) {
	return;
}

Style::register(
	[
		'.p-footer-sticky-nav .c-navbar__item[data-active-menu="true"] > a',
	],
	'color: ' . $accent_color
);
