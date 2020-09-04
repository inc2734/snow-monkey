<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.8
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'widget-title-style',
	[
		'label'    => __( 'Design of widget-titles', 'snow-monkey' ),
		'priority' => 280,
		'default'  => 'standard',
		'choices'  => [
			''         => __( 'None', 'snow-monkey' ),
			'standard' => __( 'Standard', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'widget-title-style' );
$control->join( $section )->join( $panel );
