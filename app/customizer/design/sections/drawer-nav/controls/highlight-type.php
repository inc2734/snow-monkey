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
	'drawer-nav-highlight-type',
	[
		'label'    => __( 'Drawer navigation highlight type', 'snow-monkey' ),
		'priority' => 120,
		'default'  => 'background-color',
		'choices'  => [
			''                 => __( 'None', 'snow-monkey' ),
			'background-color' => __( 'Background color', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'drawer-nav' );
$control = Framework::get_control( 'drawer-nav-highlight-type' );
$control->join( $section )->join( $panel );
