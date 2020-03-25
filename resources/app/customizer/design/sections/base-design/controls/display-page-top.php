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
	'display-page-top',
	[
		'label'    => __( 'Display the page top button', 'snow-monkey' ),
		'priority' => 260,
		'default'  => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'display-page-top' );
$control->join( $section )->join( $panel );
