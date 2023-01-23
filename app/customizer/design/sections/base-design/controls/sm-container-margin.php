<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'sm-container-margin',
	array(
		'label'    => __( 'Contents left/right margins on mobile device', 'snow-monkey' ),
		'priority' => 150,
		'default'  => '',
		'choices'  => array(
			's' => __( 'Narrow', 'snow-monkey' ),
			''  => __( 'Standard', 'snow-monkey' ),
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'sm-container-margin' );
$control->join( $section )->join( $panel );
