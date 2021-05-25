<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

$infobar_font_color       = get_theme_mod( 'infobar-font-color' );
$infobar_background_color = get_theme_mod( 'infobar-background-color' );

if ( $infobar_font_color ) {
	Style::register(
		'.p-infobar__inner',
		'background-color: ' . $infobar_background_color
	);
}

if ( $infobar_background_color ) {
	Style::register(
		'.p-infobar__content',
		'color: ' . $infobar_font_color
	);
}
