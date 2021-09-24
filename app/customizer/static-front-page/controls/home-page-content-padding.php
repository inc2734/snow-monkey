<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.8.1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'home-page-content-padding',
	[
		'label'           => __( 'Add vertical padding to content area of homepage', 'snow-monkey' ),
		'default'         => true,
		'priority'        => 120,
		'active_callback' => function() {
			$page_on_front        = get_option( 'page_on_front' );
			$use_static_frontpage = 'page' === get_option( 'show_on_front' ) && ! empty( $page_on_front );

			return $use_static_frontpage;
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
