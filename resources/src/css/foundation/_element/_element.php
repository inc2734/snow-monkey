<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

Style::register(
	'a',
	'color: ' . get_theme_mod( 'accent-color' )
);

Style::register(
	[
		'input[type="email"]',
		'input[type="number"]',
		'input[type="password"]',
		'input[type="search"]',
		'input[type="tel"]',
		'input[type="text"]',
		'input[type="url"]',
		'textarea',
	],
	'font-size: ' . get_theme_mod( 'base-font-size' ) . 'px'
);
