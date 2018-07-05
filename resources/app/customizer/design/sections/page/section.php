<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'design' );

$customizer->section( 'page', [
	'title'           => __( 'Page settings', 'snow-monkey' ),
	'description'     => __( 'By the type of page displayed on the preview screen on the right side of the screen, the display setting items switched.', 'snow-monkey' ) . __( 'Currently page settings is displayed.', 'snow-monkey' ),
	'priority'        => 110,
	'active_callback' => function() {
		return ( is_page() && ! is_front_page() );
	},
] );
