<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'use-lightweight-fontawesome',
	array(
		'label'    => __( 'Use lightweight FontAwesome', 'snow-monkey' ),
		'priority' => 170,
		'default'  => false,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'use-lightweight-fontawesome' );
$control->join( $section );
