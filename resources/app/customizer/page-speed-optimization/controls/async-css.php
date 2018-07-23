<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control( 'checkbox', 'async-css', [
	'label'    => __( 'Loads CSS asynchronously', 'snow-monkey' ),
	'priority' => 120,
	'default'  => false,
] );

if ( ! is_customize_preview() ) {
	return;
}

$section = $customizer->get_section( 'page-speed-optimization' );
$control = $customizer->get_control( 'async-css' );
$control->join( $section );
