<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;

if ( ! Helper::is_ie() ) {
	return;
}

$accent_color = get_theme_mod( 'accent-color' );
if ( ! $accent_color ) {
	return;
}

Style::register(
	'.wp-profile-box__detail-btn',
	[
		'background-color: ' . $accent_color,
		'border-color: ' . $accent_color,
	]
);

Style::register(
	'.wp-profile-box__archives-btn',
	[
		'border-color: ' . $accent_color,
		'color: ' . $accent_color,
	]
);
