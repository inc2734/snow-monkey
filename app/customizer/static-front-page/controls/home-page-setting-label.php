<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'content',
	'home-page-setting-label',
	array(
		'label'           => __( 'Front page setting', 'snow-monkey' ),
		'priority'        => 100,
		'active_callback' => function() {
			$page_on_front = get_option( 'page_on_front' );
			return 'page' === get_option( 'show_on_front' ) && ! empty( $page_on_front );
		},
	)
);

$section = Framework::get_section( 'static_front_page' );
$control = Framework::get_control( 'home-page-setting-label' );
$control->join( $section );
