<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'header-position-only-mobile',
	[
		'label'    => __( 'Use header position setting for mobile only', 'snow-monkey' ),
		'priority' => 120,
		'default'  => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'layout' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-position-only-mobile' );
$control->join( $section )->join( $panel );
