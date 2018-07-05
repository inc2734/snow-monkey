<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'layout' );

$customizer->section( 'singular-post', [
	'title'           => __( 'Page layout', 'snow-monkey' ),
	'description'     => __( 'By the type of page displayed on the preview screen on the right side of the screen, the display setting items switched.', 'snow-monkey' ) . __( 'Currently singular post settings is displayed.', 'snow-monkey' ),
	'priority'        => 120,
	'active_callback' => function() {
		return ( ! is_front_page() && ( is_singular() || is_404() ) );
	},
] );
