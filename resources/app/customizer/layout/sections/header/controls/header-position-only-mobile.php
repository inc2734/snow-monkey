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
	'header-position-only-mobile',
	[
		'label'    => __( 'Use header position setting for mobile only', 'snow-monkey' ),
		'priority' => 120,
		'default'  => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'layout' );
$section = $customizer->get_section( 'header' );
$control = $customizer->get_control( 'header-position-only-mobile' );
$control->join( $section )->join( $panel );
