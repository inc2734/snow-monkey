<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'multiple-checkbox',
	'noto-sans-jp-font-weight',
	[
		'label'             => __( 'Font weight', 'snow-monkey' ),
		'default'           => '400,700',
		'priority'          => 121,
		'choices'           => [
			'100' => __( 'Thin 100', 'snow-monkey' ),
			'300' => __( 'Light 300', 'snow-monkey' ),
			'400' => __( 'Regular 400', 'snow-monkey' ),
			'500' => __( 'Medium 500', 'snow-monkey' ),
			'700' => __( 'Bold 700', 'snow-monkey' ),
			'900' => __( 'Black 900', 'snow-monkey' ),
		],
		'active_callback'   => function() {
			return 'noto-sans-jp' === get_theme_mod( 'base-font' );
		},
		'sanitize_callback' => function( $value ) {
			return $value ? $value : '400,700';
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'noto-sans-jp-font-weight' );
$control->join( $section )->join( $panel );
