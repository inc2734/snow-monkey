<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.7
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'posts-page-display-title',
	[
		'label'           => __( 'Display posts page title', 'snow-monkey' ),
		'default'         => true,
		'priority'        => 210,
		'active_callback' => function() {
			$page_on_front = get_option( 'page_on_front' );
			return 'page' === get_option( 'show_on_front' ) && ! empty( $page_on_front );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'static_front_page' );
$control = Framework::get_control( 'posts-page-display-title' );
$control->join( $section );
