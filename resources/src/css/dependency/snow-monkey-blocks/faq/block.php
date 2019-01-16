<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;

$accent_color = get_theme_mod( 'accent-color' );

Style::register(
	[
		'.smb-faq__item__question__label',
		'.smb-faq__item__answer__label',
	],
	'color: ' . $accent_color
);
