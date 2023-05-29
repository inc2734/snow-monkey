<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'post-entries-gap',
	array(
		'label'    => __( 'The gap between each item in the entries', 'snow-monkey' ),
		'priority' => 110,
		'default'  => '',
		'choices'  => array(
			''  => __( 'Default', 'snow-monkey' ),
			's' => __( 'S', 'snow-monkey' ),
			'm' => __( 'M', 'snow-monkey' ),
			'l' => __( 'L', 'snow-monkey' ),
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'entries' );
$control = Framework::get_control( 'post-entries-gap' );
$control->join( $section )->join( $panel );
