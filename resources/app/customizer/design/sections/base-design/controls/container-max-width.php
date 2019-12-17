<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
 *
 * renamed: app/customizer/layout/sections/base-layout/controls/container-max-width.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'number',
	'container-max-width',
	[
		'label'       => __( 'Contents max width', 'snow-monkey' ),
		'description' => __( 'You can set max width of contents area (1024 - 1280)', 'snow-monkey' ),
		'priority'    => 140,
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

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'container-max-width' );
$control->join( $section )->join( $panel );
