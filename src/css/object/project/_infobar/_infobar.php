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

$styles = [];

if ( $infobar_font_color ) {
	$styles[] = [
		'selectors'  => [ '.p-infobar__inner' ],
		'properties' => [ 'background-color: ' . $infobar_background_color ],
	];
}

if ( $infobar_background_color ) {
	$styles[] = [
		'selectors'  => [ '.p-infobar__content' ],
		'properties' => [ 'color: ' . $infobar_font_color ],
	];
}

if ( $styles ) {
	Style::attach(
		Helper::get_main_style_handle(),
		$styles
	);
}
