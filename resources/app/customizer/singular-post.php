<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'singular-post', [
	'title'           => __( 'Singular post settings', 'snow-monkey' ),
	'description'     => __( 'Applies to singular post.', 'snow-monkey' ),
	'priority'        => 1110,
	'active_callback' => function() {
		return ( ! is_front_page() && ( is_single() || is_page() || is_404() ) );
	},
] );

$section = $customizer->get_section( 'singular-post' );

/**
 * Layout
 */
$customizer->control( 'select', 'singular-post-layout', [
	'label'   => __( 'Page layout', 'snow-monkey' ),
	'default' => 'right-sidebar',
	'choices' => snow_monkey_get_page_templates(),
] );

$control = $customizer->get_control( 'singular-post-layout' );
$control->join( $section );

/**
 * Contents outline - Only post
 */
$customizer->control( 'checkbox', 'mwt-display-contents-outline', [
	'label'   => __( 'Display contents outline in posts', 'snow-monkey' ),
	'type'    => 'option',
	'default' => true,
	'active_callback' => function() {
		return is_single();
	},
] );

$control = $customizer->get_control( 'mwt-display-contents-outline' );
$control->join( $section );
$control->partial( [
	'selector' => '.c-entry__content .wpco',
] );

/**
 * Profile Box - Only post
 */
$customizer->control( 'checkbox', 'mwt-display-profile-box', [
	'transport' => 'postMessage',
	'label'     => __( 'Display profile box in posts', 'snow-monkey' ),
	'type'      => 'option',
	'default'   => true,
	'active_callback' => function() {
		return is_single();
	},
] );

$control = $customizer->get_control( 'mwt-display-profile-box' );
$control->join( $section );
$control->partial( [
	'selector'            => '.wp-profile-box',
	'container_inclusive' => true,
	'render_callback'     => function() {
		get_template_part( 'template-parts/profile-box' );
	},
] );

/**
 * Related posts - Only post
 */
$customizer->control( 'checkbox', 'mwt-display-related-posts', [
	'transport' => 'postMessage',
	'label'     => __( 'Display related posts in posts', 'snow-monkey' ),
	'type'      => 'option',
	'default'   => true,
	'active_callback' => function() {
		return is_single();
	},
] );

$control = $customizer->get_control( 'mwt-display-related-posts' );
$control->join( $section );
$control->partial( [
	'selector'            => '.p-related-posts',
	'container_inclusive' => true,
	'render_callback'     => function() {
		get_template_part( 'template-parts/related-posts' );
	},
] );
