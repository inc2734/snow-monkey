<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'layout', [
	'title' => __( 'Layout', 'snow-monkey' ),
] );

$customizer->control( 'select', 'basic-layout', [
	'label'   => __( 'Basic layout', 'snow-monkey' ),
	'default' => 'right-sidebar',
	'choices' => [
		'left-sidebar'     => __( 'Left sidebar', 'snow-monkey' ),
		'right-sidebar'    => __( 'Right sidebar', 'snow-monkey' ),
		'one-column'       => __( 'One column', 'snow-monkey' ),
		'one-column-fluid' => __( 'One column (fluid)', 'snow-monkey' ),
		'one-column-slim'  => __( 'One column (slim)', 'snow-monkey' ),
	],
] );

$customizer->control( 'select', 'header-layout', [
	'label'   => __( 'Header layout', 'snow-monkey' ),
	'default' => '2row',
	'choices' => [
		'simple' => __( 'Simple', 'snow-monkey' ),
		'1row'   => __( 'One row', 'snow-monkey' ),
		'2row'   => __( 'Two rows', 'snow-monkey' ),
		'center' => __( 'Center logo', 'snow-monkey' ),
	],
] );

$customizer->control( 'select', 'footer-widget-area-column-size', [
	'label'   => __( 'Number of columns in the footer widget aera', 'snow-monkey' ),
	'default' => '1-3',
	'choices' => [
		'1-1' => __( '1 column', 'snow-monkey' ),
		'1-2' => __( '2 columns', 'snow-monkey' ),
		'1-3' => __( '3 columns', 'snow-monkey' ),
		'1-4' => __( '4 columns', 'snow-monkey' ),
	],
] );

$section = $customizer->get_section( 'layout' );
$control = $customizer->get_control( 'basic-layout' );
$control->join( $section );

$control = $customizer->get_control( 'header-layout' );
$control->join( $section );

$control = $customizer->get_control( 'footer-widget-area-column-size' );
$control->join( $section );
