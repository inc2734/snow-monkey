<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'multiple-checkbox',
	'biz-udpgothic-font-weight',
	array(
		'label'             => __( 'Font weight', 'snow-monkey' ),
		'default'           => '400,700',
		'priority'          => 121,
		'choices'           => array(
			'400' => __( 'Regular 400', 'snow-monkey' ),
			'700' => __( 'Bold 700', 'snow-monkey' ),
		),
		'active_callback'   => function() {
			return 'biz-udpgothic' === get_theme_mod( 'base-font' );
		},
		'sanitize_callback' => function( $value ) {
			return $value ? $value : '400,700';
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'biz-udpgothic-font-weight' );
$control->join( $section )->join( $panel );
