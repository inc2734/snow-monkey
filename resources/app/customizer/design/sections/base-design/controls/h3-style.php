<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.8
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'h3-style',
	[
		// translators: %1$s: heading element
		'label'    => sprintf( __( 'Design of the %1$s in articles', 'snow-monkey' ), 'h3' ),
		'priority' => 271,
		'default'  => 'standard',
		'choices'  => [
			''         => __( 'None', 'snow-monkey' ),
			'standard' => __( 'Standard', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'h3-style' );
$control->join( $section )->join( $panel );
