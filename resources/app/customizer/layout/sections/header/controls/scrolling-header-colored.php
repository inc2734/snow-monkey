<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
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
			return 'sticky-overlay' === get_theme_mod( 'header-position' );
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
