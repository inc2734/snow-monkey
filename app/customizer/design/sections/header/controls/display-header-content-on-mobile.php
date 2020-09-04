<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/layout/sections/header/controls/display-header-content-on-mobile.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'display-header-content-on-mobile',
	[
		'label'    => __( 'Display header content on mobile too.', 'snow-monkey' ),
		'priority' => 140,
		'default'  => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'display-header-content-on-mobile' );
$control->join( $section )->join( $panel );
