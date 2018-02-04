<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'page', [
	'title'           => __( 'Page settings', 'snow-monkey' ),
	'description'     => __( 'Applies to page.', 'snow-monkey' ),
	'priority'        => 1110,
	'active_callback' => function() {
		return ( ! is_front_page() && is_page() );
	},
] );

$section = $customizer->get_section( 'page' );

/**
 * Child pages - Only page
 */
$customizer->control( 'checkbox', 'mwt-display-child-pages', [
	'transport' => 'postMessage',
	'label'     => __( 'Display child pages in page', 'snow-monkey' ),
	'type'      => 'option',
	'default'   => true,
	'active_callback' => function() {
		return is_page();
	},
] );

$control = $customizer->get_control( 'mwt-display-child-pages' );
$control->join( $section );
$control->partial( [
	'selector'            => '.p-child-pages',
	'container_inclusive' => true,
	'render_callback'     => function() {
		get_template_part( 'template-parts/child-pages' );
	},
] );
