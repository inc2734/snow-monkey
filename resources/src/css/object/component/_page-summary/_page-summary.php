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
	'.c-entries--rich-media .c-page-summary .c-page-summary__figure::after',
	'background-image: radial-gradient(' . Color::rgba( $accent_color, .5 ) . ' 33%, transparent 33%)'
);

Style::register(
	'.c-page-summary__more',
	[
		'border-color: ' . $accent_color,
		'color: ' . $accent_color,
	]
);

Style::register(
	[
		'.c-page-summary__more:hover',
		'.c-page-summary__more:active',
		'.c-page-summary__more:focus',
	],
	'background-color: ' . $accent_color,
	'@media (min-width: 64em)'
);
