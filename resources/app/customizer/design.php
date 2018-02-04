<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'design', [
	'title' => __( 'Design', 'snow-monkey' ),
	'priority' => 1100,
] );

$section = $customizer->get_section( 'design' );

/**
 * Base font size
 */
$customizer->control( 'number', 'base-font-size', [
	'label'   => __( 'Base font size(px)', 'snow-monkey' ),
	'default' => 16,
] );

$control = $customizer->get_control( 'base-font-size' );
$control->join( $section );

/**
 * Accent color
 */
$customizer->control( 'color', 'accent-color', [
	'label'   => __( 'Accent color', 'snow-monkey' ),
	'default' => '#bd3c4f',
] );

$control = $customizer->get_control( 'accent-color' );
$control->join( $section );

/**
 * Header layout
 */
$customizer->control( 'select', 'header-layout', [
	'transport' => 'postMessage',
	'label'     => __( 'Header layout', 'snow-monkey' ),
	'default'   => 'center',
	'choices'   => [
		'simple' => __( 'Simple', 'snow-monkey' ),
		'1row'   => __( 'One row', 'snow-monkey' ),
		'2row'   => __( 'Two rows', 'snow-monkey' ),
		'center' => __( 'Center logo', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'header-layout' );
$control->join( $section );
$control->partial( [
	'selector'        => '.l-header',
	'render_callback' => function() {
		get_template_part( 'template-parts/' . get_theme_mod( 'header-layout' ) . '-header' );
	},
] );

/**
 * Header contents
 */
$customizer->control( 'textarea', 'header-content', [
	'transport'   => 'postMessage',
	'label'       => __( 'Header contents', 'snow-monkey' ),
	'description' => __( 'Displayed at only PC size.', 'snow-monkey' ),
] );

$control = $customizer->get_control( 'header-content' );
$control->join( $section );
$control->partial( [
	'selector'            => '#js-selective-refresh-header-content',
	'container_inclusive' => true,
	'render_callback'     => function() {
		get_template_part( 'template-parts/header-content' );
	},
] );

/**
 * Footer layout
 */
$customizer->control( 'select', 'footer-widget-area-column-size', [
	'transport' => 'postMessage',
	'label'     => __( 'Number of columns in the footer widget area', 'snow-monkey' ),
	'default'   => '1-4',
	'choices' => [
		'1-1' => __( '1 column', 'snow-monkey' ),
		'1-2' => __( '2 columns', 'snow-monkey' ),
		'1-3' => __( '3 columns', 'snow-monkey' ),
		'1-4' => __( '4 columns', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'footer-widget-area-column-size' );
$control->join( $section );
$control->partial( [
	'selector'            => '.l-footer-widget-area',
	'container_inclusive' => true,
	'render_callback'     => function() {
		get_template_part( 'template-parts/footer-widget-area' );
	},
] );

/**
 * Archive layout
 */
$customizer->control( 'select', 'archive-layout', [
	'label'   => __( 'Archive layout', 'snow-monkey' ),
	'default' => 'rich-media',
	'choices' => [
		'rich-media' => __( 'Rich media', 'snow-monkey' ),
		'simple'     => __( 'Simple', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'archive-layout' );
$control->join( $section );

/**
 * Custom logo scale
 */
$custom_logo = get_custom_logo();
if ( $custom_logo ) {
	preg_match( '/height="(\d+?)"/', $custom_logo, $reg );
	if ( ! isset( $reg[1] ) ) {
		return;
	}
	$height = $reg[1];

	$customizer->control( 'number', 'sm-logo-scale', [
		'label'       => __( 'Custom logo scale (%) on smartphone', 'snow-monkey' ),
		'default'     => 33,
		'input_attrs' => [
			'min' => 33,
			'max' => 50,
		],
	] );

	$control = $customizer->get_control( 'sm-logo-scale' );
	$control->join( $section );
}
