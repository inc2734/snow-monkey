<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'image',
	'default-page-header-image',
	[
		'label'    => __( 'Default page header image', 'snow-monkey' ),
		'priority' => 140,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'base-design' );
$control = $customizer->get_control( 'default-page-header-image' );
$control->join( $section )->join( $panel );
