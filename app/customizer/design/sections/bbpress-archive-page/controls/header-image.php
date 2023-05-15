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
	'bbpress-archive-header-image',
	array(
		'label'    => __( 'Featured Image', 'snow-monkey' ),
		'priority' => 110,
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-bbpress-archive-page' );
$control = Framework::get_control( 'bbpress-archive-header-image' );
$control->join( $section )->join( $panel );
