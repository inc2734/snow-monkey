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
	'base-font-size',
	array(
		'default'          => 16,
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Base font size(px)', 'snow-monkey' ),
				'priority' => 110,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'base-font-size' );
$control->join( $section )->join( $panel );
