<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'disable-emoji',
	array(
		'default'          => false,
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Disable emoji', 'snow-monkey' ),
				'priority' => 190,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'disable-emoji' );
$control->join( $section );
