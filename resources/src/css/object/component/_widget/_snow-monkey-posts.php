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
	'.snow-monkey-posts__more',
	'background-color: ' . $accent_color
);

Style::register(
	'.snow-monkey-posts__title::after',
	'background-color: ' . $accent_color
);
