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
	'.c-entry__content > h2::after',
	"background-color: " . $accent_color
);

$cfs->register(
	'.c-entry__content > table thead th',
	[
		"background-color: " . $accent_color,
		"border-right-color: " . $cfs->light( $accent_color ),
		"border-left-color: " . $cfs->light( $accent_color ),
	]
);
