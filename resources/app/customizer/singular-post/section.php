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
