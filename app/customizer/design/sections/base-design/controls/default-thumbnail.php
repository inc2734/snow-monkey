<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'image',
	'default-thumbnail',
	array(
		'label'    => __( 'Default thumbnail', 'snow-monkey' ),
		'priority' => 210,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'default-thumbnail' );
$control->join( $section )->join( $panel );
