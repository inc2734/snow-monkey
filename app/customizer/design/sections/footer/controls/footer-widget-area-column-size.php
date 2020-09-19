<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.4.0
 *
 * renamed: app/customizer/layout/sections/footer/controls/footer-layout.php
 * renamed: app/customizer/design/sections/footer/controls/footer-layout.php
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'footer-widget-area-column-size',
	[
		'label'           => __( 'Number of columns in the footer widget area on PC', 'snow-monkey' ),
		'priority'        => 100,
		'default'         => '1-4',
		'choices'         => [
			'1-1' => __( '1 column', 'snow-monkey' ),
			'1-2' => __( '2 columns', 'snow-monkey' ),
			'1-3' => __( '3 columns', 'snow-monkey' ),
			'1-4' => __( '4 columns', 'snow-monkey' ),
		],
		'active_callback' => function() {
			return Helper::is_active_sidebar( 'footer-widget-area' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'footer' );
$control = Framework::get_control( 'footer-widget-area-column-size' );
$control->join( $section )->join( $panel );
