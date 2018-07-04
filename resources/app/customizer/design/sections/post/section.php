<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'design' );

$customizer->section( 'post', [
	'title'           => __( 'Page settings', 'snow-monkey' ),
	'description'     => __( 'The setting items displayed by the page being displayed are switched.', 'snow-monkey' ) . __( 'Currently post settings is displayed.', 'snow-monkey' ),
	'priority'        => 110,
	'active_callback' => function() {
		return is_singular( 'post' );
	},
] );
