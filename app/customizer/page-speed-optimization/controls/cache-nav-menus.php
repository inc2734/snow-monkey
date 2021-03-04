<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'cache-nav-menus',
	[
		'label'    => __( 'Caching nav menus', 'snow-monkey' ),
		'priority' => 220,
		'default'  => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'cache-nav-menus' );
$control->join( $section );
