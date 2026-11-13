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
	'cache-widget-areas',
	array(
		'default'          => false,
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Caching widget areas', 'snow-monkey' ),
				'priority' => 230,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'cache-widget-areas' );
$control->join( $section );
