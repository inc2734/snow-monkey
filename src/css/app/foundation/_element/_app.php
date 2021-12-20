<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

$styles = [];

$styles[] = [
	'selectors'  => [
		'input[type="email"]',
		'input[type="number"]',
		'input[type="password"]',
		'input[type="search"]',
		'input[type="tel"]',
		'input[type="text"]',
		'input[type="url"]',
		'textarea',
	],
	'properties' => [
		'font-size: ' . get_theme_mod( 'base-font-size' ) . 'px',
	],
];

if ( $styles ) {
	Style::attach(
		Helper::get_main_style_handle() . '-app',
		$styles
	);
}
