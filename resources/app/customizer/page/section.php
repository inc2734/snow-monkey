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
	'priority'        => 1120,
	'active_callback' => function() {
		return ( is_page() && ! is_front_page() );
	},
] );
