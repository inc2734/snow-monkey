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

$panel   = $customizer->get_panel( 'layout' );
$section = $customizer->get_section( 'header' );
$control = $customizer->get_control( 'display-header-content-on-mobile' );
$control->join( $section )->join( $panel );
