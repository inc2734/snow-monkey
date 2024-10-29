<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.3.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'drawer-nav-direction',
	array(
		'label'           => __( 'Drawer navigation direction', 'snow-monkey' ),
		'priority'        => 120,
		'default'         => '',
		'choices'         => array(
			''      => __( 'Default', 'snow-monkey' ),
			'right' => __( 'Display from right', 'snow-monkey' ),
			'left'  => __( 'Display from left', 'snow-monkey' ),
		),
		'active_callback' => function () {
			return 'overall' !== get_theme_mod( 'drawer-nav-type' );
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'drawer-nav' );
$control = Framework::get_control( 'drawer-nav-direction' );
$control->join( $section )->join( $panel );
