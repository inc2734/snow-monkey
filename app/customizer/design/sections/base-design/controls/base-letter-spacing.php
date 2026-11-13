<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'number',
	'base-letter-spacing',
	array(
		'default'          => 0.05,
		'ui_args_callback' => function () {
			return array(
				'label'       => __( 'Base letter spacing (rem)', 'snow-monkey' ),
				'priority'    => 114,
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 1,
					'step' => 0.01,
				),
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'base-letter-spacing' );
$control->join( $section )->join( $panel );
