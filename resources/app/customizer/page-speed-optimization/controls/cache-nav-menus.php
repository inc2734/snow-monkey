<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control( 'checkbox', 'cache-nav-menus', [
	'label'    => __( 'Cache nav menus', 'snow-monkey' ),
	'priority' => 150,
	'default'  => false,
] );

if ( ! is_customize_preview() ) {
	return;
}

$section = $customizer->get_section( 'page-speed-optimization' );
$control = $customizer->get_control( 'cache-nav-menus' );
$control->join( $section );
