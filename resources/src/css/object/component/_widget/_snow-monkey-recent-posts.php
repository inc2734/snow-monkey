<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

$accent_color = get_theme_mod( 'accent-color' );

Style::register(
	'.snow-monkey-recent-posts__more',
	'background-color: ' . $accent_color
);

Style::register(
	[
		'.snow-monkey-recent-posts__more:hover',
		'.snow-monkey-recent-posts__more:active',
		'.snow-monkey-recent-posts__more:focus',
	],
	'background-color: ' . Style::darken( $accent_color, 0.05 ),
	'@media (min-width: 64em)'
);

Style::register(
	'.snow-monkey-recent-posts__title::after',
	'background-color: ' . $accent_color
);
