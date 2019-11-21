<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'header-position-fixed',
	[
		'label'    => __( 'Fix header position', 'snow-monkey' ),
		'priority' => 119,
		'default'  => true,
		'active_callback' => function() {
			return 'overlay' === get_theme_mod( 'header-position' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'layout' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-position-fixed' );
$control->join( $section )->join( $panel );
