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
	'slim-width',
	array(
		'label'       => __( 'Slim width', 'snow-monkey' ),
		'description' => __( 'You can set the width when the slim width is specified.', 'snow-monkey' ) . __( 'Numeric values only are treated as px.', 'snow-monkey' ),
		'priority'    => 145,
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'slim-width' );
$control->join( $section )->join( $panel );
