<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'design' );

$customizer->control( 'select', 'breadcrumbs-position', [
	'label'    => __( 'Breadcrumbs display position', 'snow-monkey' ),
	'default'  => 'default',
	'priority' => 170,
	'choices'  => [
		'default'              => __( 'Top of contents', 'snow-monkey' ),
		'content-width'        => __( 'Top of contents ( Fit to content width )', 'snow-monkey' ),
		'bottom'               => __( 'Bottom of contents', 'snow-monkey' ),
		'bottom-content-width' => __( 'Bottom of contents ( Fit to content width )', 'snow-monkey' ),
		'none'                 => __( 'None', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'breadcrumbs-position' );
$control->join( $section );
$control->partial( [
	'selector' => '.c-breadcrumbs',
] );
