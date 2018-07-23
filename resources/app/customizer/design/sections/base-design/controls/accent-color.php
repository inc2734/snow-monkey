<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control( 'color', 'accent-color', [
	'label'    => __( 'Accent color', 'snow-monkey' ),
	'default'  => '#bd3c4f',
	'priority' => 100,
] );

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'base-design' );
$control = $customizer->get_control( 'accent-color' );
$control->join( $section )->join( $panel );
