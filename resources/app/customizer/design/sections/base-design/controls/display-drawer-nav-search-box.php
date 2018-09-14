<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'checkbox',
	'display-drawer-nav-search-box',
	[
		'transport' => 'postMessage',
		'label'     => __( 'Display the search box in drawer navigation', 'snow-monkey' ),
		'priority'  => 170,
		'default'   => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'base-design' );
$control = $customizer->get_control( 'display-drawer-nav-search-box' );
$control->join( $section )->join( $panel );
$control->partial(
	[
		'selector'        => '#drawer-nav .p-search-form',
		'active_callback' => function() {
			return has_nav_menu( 'drawer-nav' );
		},
	]
);
