<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.7.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'image',
	'bbpress-archive-header-image',
	[
		'label'    => __( 'Featured Image', 'snow-monkey' ),
		'priority' => 110,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-bbpress-archive-page' );
$control = Framework::get_control( 'bbpress-archive-header-image' );
$control->join( $section )->join( $panel );
