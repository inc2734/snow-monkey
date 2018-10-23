<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'number',
	'container-max-width',
	[
		'label'       => __( 'Contents max width', 'snow-monkey' ),
		'description' => __( 'You can set max width of contents area (1024 - 1280)', 'snow-monkey' ),
		'priority'    => 100,
		'default'     => '1280',
		'input_attrs' => [
			'step' => 1,
			'min'  => 1024,
			'max'  => 1280,
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'layout' );
$section = $customizer->get_section( 'base-layout' );
$control = $customizer->get_control( 'container-max-width' );
$control->join( $section )->join( $panel );
