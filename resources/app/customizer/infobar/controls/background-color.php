<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.7.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'color',
	'infobar-background-color',
	[
		'label'    => __( 'Background color', 'snow-monkey' ),
		'default'  => '#ffca00',
		'priority' => 130,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-background-color' );
$control->join( $section );
