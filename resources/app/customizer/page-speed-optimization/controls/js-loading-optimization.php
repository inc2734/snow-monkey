<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'js-loading-optimization',
	[
		'label'    => __( 'Optimize the Snow Monkey JavaScript loading', 'snow-monkey' ),
		'priority' => 100,
		'default'  => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'js-loading-optimization' );
$control->join( $section );
