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
	'cache-footer',
	array(
		'label'    => __( 'Caching footer', 'snow-monkey' ),
		'priority' => 210,
		'default'  => false,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'cache-footer' );
$control->join( $section );
