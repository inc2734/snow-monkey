<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'sm-container-margin',
	[
		'label'    => __( 'Contents left/right margins on mobile device', 'snow-monkey' ),
		'priority' => 150,
		'default'  => '',
		'choices'  => [
			''  => __( 'Standard', 'snow-monkey' ),
			'm' => __( 'Wide', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'sm-container-margin' );
$control->join( $section )->join( $panel );
