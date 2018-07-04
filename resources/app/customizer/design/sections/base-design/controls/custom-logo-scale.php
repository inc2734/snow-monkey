<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'design' );
$section    = $customizer->get_section( 'base-design' );

$custom_logo = get_custom_logo();
if ( ! $custom_logo ) {
	return;
}

preg_match( '/height="(\d+?)"/', $custom_logo, $reg );
if ( ! isset( $reg[1] ) ) {
	return;
}

$height = $reg[1];

$customizer->control( 'number', 'sm-logo-scale', [
	'label'       => __( 'Custom logo scale (%) on smartphone', 'snow-monkey' ),
	'priority'    => 160,
	'default'     => 33,
	'input_attrs' => [
		'min' => 33,
		'max' => 50,
	],
] );

$control = $customizer->get_control( 'sm-logo-scale' );
$control->join( $section )->join( $panel );
