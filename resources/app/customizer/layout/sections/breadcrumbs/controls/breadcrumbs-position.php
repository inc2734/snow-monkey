<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control( 'select', 'breadcrumbs-position', [
	'label'    => __( 'Breadcrumbs display position', 'snow-monkey' ),
	'default'  => 'default',
	'choices'  => [
		'default'              => __( 'Top of contents', 'snow-monkey' ),
		'content-width'        => __( 'Top of contents ( Fit to content width )', 'snow-monkey' ),
		'bottom'               => __( 'Bottom of contents', 'snow-monkey' ),
		'bottom-content-width' => __( 'Bottom of contents ( Fit to content width )', 'snow-monkey' ),
		'none'                 => __( 'None', 'snow-monkey' ),
	],
] );

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'layout' );
$section = $customizer->get_section( 'breadcrumbs' );
$control = $customizer->get_control( 'breadcrumbs-position' );
$control->join( $section )->join( $panel );
$control->partial( [
	'selector' => '.c-breadcrumbs',
] );
