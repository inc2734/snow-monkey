<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'color',
	'header-text-color',
	array(
		'label'    => __( 'Header text color', 'snow-monkey' ),
		'default'  => '',
		'priority' => 170,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-text-color' );
$control->join( $section )->join( $panel );
