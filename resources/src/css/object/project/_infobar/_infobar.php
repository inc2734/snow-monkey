<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

$infobar_font_color       = get_theme_mod( 'infobar-font-color' );
$infobar_background_color = get_theme_mod( 'infobar-background-color' );

Style::register(
	'.p-infobar__inner',
	[
		'background-color: ' . $infobar_background_color,
		'color: ' . $infobar_font_color,
	]
);

Style::register(
	[
		'a.p-infobar__inner:hover',
		'a.p-infobar__inner:active',
		'a.p-infobar__inner:focus',
	],
	'background-color: ' . Color::darken( $infobar_background_color, 0.05 ),
	'@media (min-width: 64em)'
);
