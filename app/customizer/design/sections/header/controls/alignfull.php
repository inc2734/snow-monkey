<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'header-alignfull',
	array(
		'label'           => __( 'Make header full width', 'snow-monkey' ),
		'priority'        => 150,
		'default'         => false,
		'active_callback' => function () {
			return 'left' !== get_theme_mod( 'header-layout' );
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-alignfull' );
$control->join( $section )->join( $panel );
