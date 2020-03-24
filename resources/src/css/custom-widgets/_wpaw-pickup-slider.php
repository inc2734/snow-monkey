<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

$accent_color = get_theme_mod( 'accent-color' );

Style::register(
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

Style::register(
	'.wpaw-pickup-slider .slick-arrow',
	'background-color: ' . $accent_color
);
