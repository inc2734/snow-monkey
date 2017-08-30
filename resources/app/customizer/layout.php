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

$post_types = get_post_types( [ 'public' => true ] );
unset( $post_types['attachment'] );
foreach ( $post_types as $post_type ) {
	$post_type_object = get_post_type_object( $post_type );
	$customizer->control( 'select', $post_type_object->name . '-layout', [
		'label'   => sprintf( __( '%1$s layout', 'snow-monkey' ), __( $post_type_object->label ) ),
		'default' => 'right-sidebar',
		'choices' => [
			'left-sidebar'     => __( 'Left sidebar', 'snow-monkey' ),
			'right-sidebar'    => __( 'Right sidebar', 'snow-monkey' ),
			'one-column'       => __( 'One column', 'snow-monkey' ),
			'one-column-fluid' => __( 'One column (fluid)', 'snow-monkey' ),
			'one-column-slim'  => __( 'One column (slim)', 'snow-monkey' ),
		],
	] );
}

$customizer->control( 'select', 'header-layout', [
	'label'   => __( 'Header layout', 'snow-monkey' ),
	'default' => 'center',
	'choices' => [
		'simple' => __( 'Simple', 'snow-monkey' ),
		'1row'   => __( 'One row', 'snow-monkey' ),
		'2row'   => __( 'Two rows', 'snow-monkey' ),
		'center' => __( 'Center logo', 'snow-monkey' ),
	],
] );

$customizer->control( 'select', 'footer-widget-area-column-size', [
	'label'   => __( 'Number of columns in the footer widget aera', 'snow-monkey' ),
	'default' => '1-4',
	'choices' => [
		'1-1' => __( '1 column', 'snow-monkey' ),
		'1-2' => __( '2 columns', 'snow-monkey' ),
		'1-3' => __( '3 columns', 'snow-monkey' ),
		'1-4' => __( '4 columns', 'snow-monkey' ),
	],
] );

$section = $customizer->get_section( 'layout' );
$post_types = get_post_types( [ 'public' => true ] );
unset( $post_types['attachment'] );
foreach ( $post_types as $post_type ) {
	$post_type_object = get_post_type_object( $post_type );
	$control = $customizer->get_control( $post_type_object->name . '-layout' );
	$control->join( $section );
}

$control = $customizer->get_control( 'header-layout' );
$control->join( $section );

$control = $customizer->get_control( 'footer-widget-area-column-size' );
$control->join( $section );
