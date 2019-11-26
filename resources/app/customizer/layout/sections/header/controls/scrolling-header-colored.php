<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.2.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'scrolling-header-colored',
	[
		'label'    => __( 'White background when scrolling', 'snow-monkey' ),
		'priority' => 119,
		'default'  => true,
		'active_callback' => function() {
			$header_position_fixed = get_theme_mod( 'header-position-fixed' );
			$header_position       = get_theme_mod( 'header-position' );
			return 'overlay' === $header_position && $header_position_fixed;
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'layout' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'scrolling-header-colored' );
$control->join( $section )->join( $panel );
