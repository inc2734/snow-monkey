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
	'pure-css-gallery',
	[
		'label'    => __( 'Use Pure CSS Gallery', 'snow-monkey' ),
		'priority' => 160,
		'default'  => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'base-design' );
$control = $customizer->get_control( 'pure-css-gallery' );
$control->join( $section )->join( $panel );
