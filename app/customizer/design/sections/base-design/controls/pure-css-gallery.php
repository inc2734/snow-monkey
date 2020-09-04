<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'pure-css-gallery',
	[
		'label'    => __( 'Use Pure CSS Gallery', 'snow-monkey' ),
		'priority' => 230,
		'default'  => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'pure-css-gallery' );
$control->join( $section )->join( $panel );
