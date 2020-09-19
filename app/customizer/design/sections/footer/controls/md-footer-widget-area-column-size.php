<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.4.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'md-footer-widget-area-column-size',
	[
		'label'           => __( 'Number of columns in the footer widget area on tablet', 'snow-monkey' ),
		'priority'        => 101,
		'default'         => '1-1',
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
$control = Framework::get_control( 'md-footer-widget-area-column-size' );
$control->join( $section )->join( $panel );
