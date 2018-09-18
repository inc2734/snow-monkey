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
	'home-page-content-padding',
	[
		'label'   => __( 'Add vertical padding to content area of homepage', 'snow-monkey' ),
		'default' => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = $customizer->get_section( 'static_front_page' );
$control = $customizer->get_control( 'home-page-content-padding' );
$control->join( $section );
$control->partial(
	[
		'selector' => '.p-section-front-page-content',
	]
);
