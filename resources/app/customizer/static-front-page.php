<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'static_front_page', [] );

/**
 * Display recent posts when using static front page
 */
$customizer->control( 'checkbox', 'display-static-front-page-recent-posts', [
	'label'   => __( 'Display recent posts when using static front page', 'snow-monkey' ),
	'default' => true,
	'active_callback' => function() {
		return ( 'page' === get_option( 'show_on_front' ) && get_option( 'page_on_front' ) && is_front_page() );
	},
] );

$section = $customizer->get_section( 'static_front_page' );
$control = $customizer->get_control( 'display-static-front-page-recent-posts' );
$control->join( $section );
$control->partial( [
	'selector' => '.home.page-template-default .p-recent-posts__title',
] );
