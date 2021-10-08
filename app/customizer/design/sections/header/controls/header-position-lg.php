<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.10.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'header-position-lg',
	[
		'label'           => __( 'Header position for PC', 'snow-monkey' ),
		'priority'        => 111,
		'default'         => '',
		'choices'         => Helper::header_position_choices(),
		'active_callback' => function() {
			return 'left' !== get_theme_mod( 'header-layout' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-position-lg' );
$control->join( $section )->join( $panel );
