<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/layout/sections/header/controls/scrolling-header-colored.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'scrolling-header-colored',
	[
		'label'    => __( 'White background when scrolling', 'snow-monkey' ),
		'priority' => 120,
		'default'  => true,
		'active_callback' => function() {
			return 'sticky-overlay' === get_theme_mod( 'header-position' ) || 'sticky-overlay' === get_theme_mod( 'header-position-lg' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'scrolling-header-colored' );
$control->join( $section )->join( $panel );
