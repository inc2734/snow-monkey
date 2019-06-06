<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'output-head-style',
	[
		'label'    => __( 'Output CSS in head', 'snow-monkey' ),
		'priority' => 130,
		'default'  => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'output-head-style' );
$control->join( $section );
