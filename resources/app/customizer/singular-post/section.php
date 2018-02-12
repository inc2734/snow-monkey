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
	'description'     => __( 'Applies to post, page and custom post.', 'snow-monkey' ),
	'priority'        => 1110,
	'active_callback' => function() {
		return ( ! is_front_page() && ( is_singular() || is_404() ) );
	},
] );
