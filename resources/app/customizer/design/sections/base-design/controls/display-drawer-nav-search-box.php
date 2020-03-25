<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'display-drawer-nav-search-box',
	[
		'transport'       => 'postMessage',
		'label'           => __( 'Display the search box in drawer navigation', 'snow-monkey' ),
		'priority'        => 250,
		'default'         => true,
		'active_callback' => function() {
			return has_nav_menu( 'drawer-nav' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'display-drawer-nav-search-box' );
$control->join( $section )->join( $panel );
