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
] );

$section = $customizer->get_section( 'design' );

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
 * Layout
 */
$_post_types = get_post_types( [
	'public' => true,
] );
unset( $_post_types['attachment'] );

$post_types = [];
foreach ( $_post_types as $post_type ) {
	$post_types[ $post_type ] = get_post_type_object( $post_type );
}

$choices = [
	'left-sidebar'     => __( 'Left sidebar', 'snow-monkey' ),
	'right-sidebar'    => __( 'Right sidebar', 'snow-monkey' ),
	'one-column'       => __( 'One column', 'snow-monkey' ),
	'one-column-fluid' => __( 'One column (fluid)', 'snow-monkey' ),
	'one-column-slim'  => __( 'One column (slim)', 'snow-monkey' ),
];

foreach ( $post_types as $post_type => $post_type_object ) {
	// singular page
	$customizer->control( 'select', $post_type_object->name . '-layout', [
		// @codingStandardsIgnoreStart
		'label'   => sprintf( __( '%1$s layout', 'snow-monkey' ), __( $post_type_object->label ) ),
		// @codingStandardsIgnoreEnd
		'default' => 'right-sidebar',
		'choices' => $choices,
	] );

	$control = $customizer->get_control( $post_type_object->name . '-layout' );
	$control->join( $section );

	// archive page
	if ( 'post' === $post_type_object->name || ! empty( $post_type_object->has_archive ) ) {
		$customizer->control( 'select', $post_type_object->name . '-archive-layout', [
			// @codingStandardsIgnoreStart
			'label'   => sprintf( __( '%1$s archive layout', 'snow-monkey' ), __( $post_type_object->label ) ),
			// @codingStandardsIgnoreEnd
			'default' => 'one-column',
			'choices' => $choices,
		] );

		$control = $customizer->get_control( $post_type_object->name . '-archive-layout' );
		$control->join( $section );
	}
}

/**
 * Header layout
 */
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

$control = $customizer->get_control( 'header-layout' );
$control->join( $section );

/**
 * Footer layout
 */
$customizer->control( 'select', 'footer-widget-area-column-size', [
	'label'   => __( 'Number of columns in the footer widget area', 'snow-monkey' ),
	'default' => '1-4',
	'choices' => [
		'1-1' => __( '1 column', 'snow-monkey' ),
		'1-2' => __( '2 columns', 'snow-monkey' ),
		'1-3' => __( '3 columns', 'snow-monkey' ),
		'1-4' => __( '4 columns', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'footer-widget-area-column-size' );
$control->join( $section );

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
 * Contents outline
 */
$customizer->control( 'checkbox', 'mwt-display-contents-outline', [
	'label'   => __( 'Display contents outline in posts', 'snow-monkey' ),
	'type'    => 'option',
	'default' => true,
] );

$section = $customizer->get_section( 'design' );
$control = $customizer->get_control( 'mwt-display-contents-outline' );
$control->join( $section );

/**
 * Profile Box
 */
$customizer->control( 'checkbox', 'mwt-display-profile-box', [
	'label'   => __( 'Display profile box in posts', 'snow-monkey' ),
	'type'    => 'option',
	'default' => true,
] );

$section = $customizer->get_section( 'design' );
$control = $customizer->get_control( 'mwt-display-profile-box' );
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

	$section = $customizer->get_section( 'design' );
	$control = $customizer->get_control( 'sm-logo-scale' );
	$control->join( $section );
}

/**
 * Display recent posts when using static front page
 */
$customizer->control( 'checkbox', 'display-static-front-page-recent-posts', [
	'label'   => __( 'Display recent posts when using static front page', 'snow-monkey' ),
	'default' => true,
	'active_callback' => function() {
		if ( 'page' === get_option( 'show_on_front' ) && get_option( 'page_on_front' ) ) {
			return true;
		}
		return false;
	},
] );

$section = $customizer->get_section( 'design' );
$control = $customizer->get_control( 'display-static-front-page-recent-posts' );
$control->join( $section );
$control->partial( [
	'selector' => '.home.page-template-default .p-recent-posts__title',
] );
