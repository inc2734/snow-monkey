<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.9.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'number',
	'space',
	[
		'label'       => __( 'White space size', 'snow-monkey' ),
		'description' => __( 'Default: ', 'snow-monkey' ) . '1.8',
		'priority'    => 161,
		'default'     => 1.8,
		'input_attrs' => [
			'min'  => .8,
			'max'  => 2.8,
			'step' => 0.1,
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'space' );
$control->join( $section )->join( $panel );
