<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'header-position-lg',
	[
		'label'           => __( 'Header position for PC', 'snow-monkey' ),
		'priority'        => 111,
		'default'         => '',
		'choices'         => [
			'sticky'                 => __( 'Sticky', 'snow-monkey' ),
			'sticky-overlay'         => __( 'Overlay (Sticky)', 'snow-monkey' ),
			'sticky-overlay-colored' => __( 'Overlay (Sticky / When scrolling, whilte background)', 'snow-monkey' ),
			'overlay'                => __( 'Overlay', 'snow-monkey' ),
			''                       => __( 'Normal', 'snow-monkey' ),
		],
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
