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
	'.wpaw-showcase__more',
	'background-color: ' . $accent_color
);

$cfs->register(
	[
		'.wpaw-showcase__more:hover',
		'.wpaw-showcase__more:active',
		'.wpaw-showcase__more:focus',
	],
	'background-color: ' . $cfs->darken( $accent_color, 0.05 )
);
