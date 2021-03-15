<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 *
 * renamed: app/customizer/layout/sections/base-layout/controls/container-max-width.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'number',
	'container-max-width',
	[
		'label'       => __( 'Contents max width', 'snow-monkey' ),
		'description' => sprintf(
			// translators: %1$s: min width, %2$s: max width
			__( 'You can set max width of contents area (%1$s - %2$s)', 'snow-monkey' ),
			1024,
			1600
		),
		'priority'    => 140,
		'default'     => '1280',
		'input_attrs' => [
			'step' => 1,
			'min'  => 1024,
			'max'  => 1600,
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'container-max-width' );
$control->join( $section )->join( $panel );
