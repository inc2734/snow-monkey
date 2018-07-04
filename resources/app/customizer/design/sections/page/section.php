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
	'description'     => __( 'The setting items displayed by the page being displayed are switched.', 'snow-monkey' ) . __( 'Currently page settings is displayed.', 'snow-monkey' ),
	'priority'        => 110,
	'active_callback' => function() {
		return ( is_page() && ! is_front_page() );
	},
] );
