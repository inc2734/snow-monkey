<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/layout/sections/header/controls/header-position-only-mobile.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'header-position-only-mobile',
	[
		'label'    => __( '[PC] Overwrite header position with "Normal"', 'snow-monkey' ),
		'priority' => 120,
		'default'  => true,
		'active_callback' => function() {
			return '' !== get_theme_mod( 'header-position' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-position-only-mobile' );
$control->join( $section )->join( $panel );
