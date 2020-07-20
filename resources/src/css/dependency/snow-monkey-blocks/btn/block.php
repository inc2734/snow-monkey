<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

if ( ! Helper::is_ie() ) {
	return;
}

$accent_color = get_theme_mod( 'accent-color' );
if ( ! $accent_color ) {
	return;
}

Style::register(
	'.smb-btn',
	'background-color: ' . $accent_color
);

Style::register(
	'.is-style-ghost > .smb-btn',
	[
		'border-color: ' . $accent_color,
		'color: ' . $accent_color,
	]
);
