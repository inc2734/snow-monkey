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
		'default'       => __( 'Default', 'snow-monkey' ),
		'content-width' => __( 'Fit to content width', 'snow-monkey' ),
		'none'          => __( 'None', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'breadcrumbs-position' );
$control->join( $section );
$control->partial( [
	'selector' => '.c-breadcrumbs',
] );
