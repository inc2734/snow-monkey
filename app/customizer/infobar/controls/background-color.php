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
	'infobar-background-color',
	array(
		'default'          => get_theme_mod( 'accent-color' ),
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Background color', 'snow-monkey' ),
				'priority' => 130,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-background-color' );
$control->join( $section );
