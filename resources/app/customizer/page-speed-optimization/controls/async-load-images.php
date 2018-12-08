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
	'async-load-images',
	[
		'label'    => __( 'Async loading of images', 'snow-monkey' ),
		'priority' => 160,
		'default'  => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = $customizer->get_section( 'page-speed-optimization' );
$control = $customizer->get_control( 'async-load-images' );
$control->join( $section );
