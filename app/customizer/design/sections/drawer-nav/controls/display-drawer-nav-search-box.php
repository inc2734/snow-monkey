<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.3.0
 *
 * renamed: app/customizer/design/sections/base-design/controls/display-drawer-nav-search-box.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'display-drawer-nav-search-box',
	[
		'transport'       => 'postMessage',
		'label'           => __( 'Display the search box in drawer navigation', 'snow-monkey' ),
		'priority'        => 130,
		'default'         => true,
		'active_callback' => function() {
			return has_nav_menu( 'drawer-nav' ) || has_nav_menu( 'drawer-sub-nav' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'drawer-nav' );
$control = Framework::get_control( 'display-drawer-nav-search-box' );
$control->join( $section )->join( $panel );
