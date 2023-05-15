<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'text',
	'has-sidebar-sidebar-basis',
	array(
		'label'       => __( 'Recommended width of the sidebar for templates with sidebars', 'snow-monkey' ),
		'description' => __( 'Numeric values only are treated as px.', 'snow-monkey' ),
		'priority'    => 146,
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'has-sidebar-sidebar-basis' );
$control->join( $section )->join( $panel );
