<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'lg-container-margin',
	array(
		'label'    => __( 'Container left/right spaces on PC', 'snow-monkey' ),
		'priority' => 151,
		'default'  => '',
		'choices'  => array(
			''  => __( 'Standard', 'snow-monkey' ),
			'l' => __( 'Wide', 'snow-monkey' ),
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'lg-container-margin' );
$control->join( $section )->join( $panel );
