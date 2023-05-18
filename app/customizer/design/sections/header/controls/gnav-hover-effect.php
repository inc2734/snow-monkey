<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'gnav-hover-effect',
	array(
		'label'    => __( 'Global navigation hover effect', 'snow-monkey' ),
		'priority' => 160,
		'default'  => 'text-color',
		'choices'  => array(
			'text-color'       => __( 'Text color reversal', 'snow-monkey' ),
			'underline'        => __( 'Underline', 'snow-monkey' ),
			'extend-underline' => __( 'Extend underline', 'snow-monkey' ),
			''                 => __( 'None', 'snow-monkey' ),
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'gnav-hover-effect' );
$control->join( $section )->join( $panel );
