<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'hamburger-btn-position',
	[
		'label'    => __( 'Hamberger button position', 'snow-monkey' ),
		'priority' => 180,
		'default'  => 'right',
		'choices'  => [
			'left'  => __( 'Left', 'snow-monkey' ),
			'right' => __( 'Right', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'hamburger-btn-position' );
$control->join( $section )->join( $panel );
