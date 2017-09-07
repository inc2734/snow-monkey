<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$cfs = Customizer_Framework::styles();

$footer_widgets_area_size = get_theme_mod( 'footer-widget-area-column-size' );
$footer_widgets_area_size = explode( '-', $footer_widgets_area_size );
$footer_widgets_area_size = array_filter( $footer_widgets_area_size );
if ( isset( $footer_widgets_area_size[0] ) ) {
	$footer_widgets_area_size = $footer_widgets_area_size[0] / $footer_widgets_area_size[1] * 100;
} else {
	$footer_widgets_area_size = 33.33333;
}

$cfs->register(
	'.l-footer-widget-area__item',
	[
		"-ms-flex: 0 1 {$footer_widgets_area_size}%",
		"flex: 0 1 {$footer_widgets_area_size}%",
		"max-width: {$footer_widgets_area_size}%",
	],
	'@media (min-width: 64em)'
);
