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
		'.wpaw-pickup-slider__item-more:hover',
		'.wpaw-pickup-slider__item-more:active',
		'.wpaw-pickup-slider__item-more:focus',
	],
	[
		'background-color: ' . $accent_color,
		'border-color: ' . $accent_color,
	],
	'@media (min-width: 64em)'
);

$cfs->register(
	[
		'a.wpaw-pickup-slider__item:hover .wpaw-pickup-slider__item-more',
		'a.wpaw-pickup-slider__item:active .wpaw-pickup-slider__item-more',
		'a.wpaw-pickup-slider__item:focus .wpaw-pickup-slider__item-more',
	],
	[
		'background-color: ' . $accent_color,
		'border-color: ' . $accent_color,
	],
	'@media (min-width: 64em)'
);

$cfs->register(
	'.wpaw-pickup-slider .slick-arrow',
	'background-color: ' . $accent_color
);

$cfs->register(
	[
		'.wpaw-pickup-slider .slick-arrow:hover',
		'.wpaw-pickup-slider .slick-arrow:active',
		'.wpaw-pickup-slider .slick-arrow:focus',
	],
	'background-color: ' . $cfs->darken( $accent_color, 0.05 ),
	'@media (min-width: 64em)'
);
