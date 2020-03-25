<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'image',
	'default-page-header-image',
	[
		'label'    => __( 'Default page header image', 'snow-monkey' ),
		'priority' => 200,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'default-page-header-image' );
$control->join( $section )->join( $panel );
