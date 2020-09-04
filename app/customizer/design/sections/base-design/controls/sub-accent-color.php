<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.2.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'color',
	'sub-accent-color',
	[
		'label'    => __( 'Sub accent color', 'snow-monkey' ),
		'default'  => '#707593',
		'priority' => 101,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'sub-accent-color' );
$control->join( $section )->join( $panel );
