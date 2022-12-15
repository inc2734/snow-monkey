<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'infobar-align',
	array(
		'label'    => __( 'Infobar text alignment', 'snow-monkey' ),
		'default'  => 'left',
		'priority' => 140,
		'choices'  => array(
			'left'   => esc_html__( 'Left', 'snow-monkey' ),
			'center' => esc_html__( 'Center', 'snow-monkey' ),
			'right'  => esc_html__( 'Right', 'snow-monkey' ),
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-align' );
$control->join( $section );
