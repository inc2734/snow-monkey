<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'multiple-checkbox',
	'biz-udpmincho-font-weight',
	array(
		'label'             => __( 'Font weight', 'snow-monkey' ),
		'default'           => '400,700',
		'priority'          => 121,
		'choices'           => array(
			'400' => __( 'Regular 400', 'snow-monkey' ),
			'400' => __( 'Bold 700', 'snow-monkey' ),
		),
		'active_callback'   => function() {
			return 'biz-udpmincho' === get_theme_mod( 'base-font' );
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
$control = Framework::get_control( 'biz-udpmincho-font-weight' );
$control->join( $section )->join( $panel );
