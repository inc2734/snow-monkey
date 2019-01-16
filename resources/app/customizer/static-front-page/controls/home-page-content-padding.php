<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'home-page-content-padding',
	[
		'label'           => __( 'Add vertical padding to content area of homepage', 'snow-monkey' ),
		'default'         => true,
		'active_callback' => function() {
			return ( 'page' === get_option( 'show_on_front' ) && ! empty( get_option( 'page_on_front' ) ) );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'static_front_page' );
$control = Framework::get_control( 'home-page-content-padding' );
$control->join( $section );
$control->partial(
	[
		'selector' => '.p-section-front-page-content',
	]
);
