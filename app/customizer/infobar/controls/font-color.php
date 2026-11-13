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
	'infobar-font-color',
	array(
		'default'          => '#fff',
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Text color', 'snow-monkey' ),
				'priority' => 120,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-font-color' );
$control->join( $section );
