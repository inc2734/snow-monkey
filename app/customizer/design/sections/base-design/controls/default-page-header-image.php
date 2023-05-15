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
	'image',
	'default-page-header-image',
	array(
		'label'    => __( 'Default page header image', 'snow-monkey' ),
		'priority' => 200,
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'default-page-header-image' );
$control->join( $section )->join( $panel );
