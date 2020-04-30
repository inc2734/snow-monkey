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

$styles = [];

if ( $infobar_font_color ) {
	$styles[] = 'background-color: ' . $infobar_background_color;
}

if ( $infobar_background_color ) {
	$styles[] = 'color: ' . $infobar_font_color;
}

Style::register(
	'.p-infobar__inner',
	$styles
);
