<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.3.1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'drawer-nav-type',
	[
		'label'    => __( 'Drawer navigation type', 'snow-monkey' ),
		'priority' => 110,
		'default'  => '',
		'choices'  => [
			''        => __( 'Default', 'snow-monkey' ),
			'overall' => __( 'Overall', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'drawer-nav' );
$control = Framework::get_control( 'drawer-nav-type' );
$control->join( $section )->join( $panel );
