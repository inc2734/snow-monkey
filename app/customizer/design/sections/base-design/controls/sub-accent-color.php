<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'color',
	'sub-accent-color',
	array(
		'default'          => '#707593',
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Sub accent color', 'snow-monkey' ),
				'priority' => 101,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'sub-accent-color' );
$control->join( $section )->join( $panel );
