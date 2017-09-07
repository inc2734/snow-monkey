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
		'.p-main-visual__item-more:hover',
		'.p-main-visual__item-more:active',
		'.p-main-visual__item-more:focus',
	],
	[
		'background-color: ' . $accent_color,
		'border-color: ' . $accent_color,
	]
);

$cfs->register(
	'.p-main-visual .slick-arrow',
	'background-color: ' . $accent_color
);

$cfs->register(
	[
		'.p-main-visual .slick-arrow:hover',
		'.p-main-visual .slick-arrow:active',
		'.p-main-visual .slick-arrow:focus',
	],
	'background-color: ' . $cfs->darken( $accent_color, 0.05 )
);
