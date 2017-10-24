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
	'.c-page-summary__more',
	[
		'border-color: ' . $accent_color,
		'color: ' . $accent_color,
	]
);

$cfs->register(
	[
		'.c-page-summary__more:hover',
		'.c-page-summary__more:active',
		'.c-page-summary__more:focus',
	],
	'background-color: ' . $accent_color,
	'@media (min-width: 64em)'
);
