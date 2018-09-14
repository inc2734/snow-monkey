<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'checkbox',
	'http2-server-push',
	[
		'label'    => __( 'Use HTTP2 Server Push', 'snow-monkey' ),
		'priority' => 110,
		'default'  => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = $customizer->get_section( 'page-speed-optimization' );
$control = $customizer->get_control( 'http2-server-push' );
$control->join( $section );
