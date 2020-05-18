<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.5.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'footer-alignfull',
	[
		'label'    => __( 'Make footer full width', 'snow-monkey' ),
		'priority' => 150,
		'default'  => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'footer' );
$control = Framework::get_control( 'footer-alignfull' );
$control->join( $section )->join( $panel );
