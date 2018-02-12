<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'post', [
	'title'           => __( 'Post settings', 'snow-monkey' ),
	'description'     => __( 'Applies to post.', 'snow-monkey' ),
	'priority'        => 1120,
	'active_callback' => function() {
		return is_singular( 'post' );
	},
] );

$section = $customizer->get_section( 'post' );
