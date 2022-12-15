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
	'infobar-position',
	array(
		'label'       => __( 'Infobar position', 'snow-monkey' ),
		'description' => __( 'Depending on the "Header position" setting, it may not appear in the specified position.', 'snow-monkey' ),
		'default'     => 'header-bottom',
		'priority'    => 150,
		'choices'     => array(
			'header-top'    => esc_html__( 'Header top', 'snow-monkey' ),
			'header-bottom' => esc_html__( 'Header bottom', 'snow-monkey' ),
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-position' );
$control->join( $section );
