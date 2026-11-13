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
	'accent-color',
	array(
		'default'          => '#cd162c',
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Accent color', 'snow-monkey' ),
				'priority' => 100,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'accent-color' );
$control->join( $section )->join( $panel );
