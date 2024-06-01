<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$wp_post_type = get_post_type_object( 'page' );

Framework::control(
	'select',
	'page-layout',
	array(
		'label'       => __( 'Page layout', 'snow-monkey' ),
		'description' => sprintf(
			/* translators: 1: Post type label */
			__( 'Select page layout for %1$s page.', 'snow-monkey' ),
			$wp_post_type->label
		),
		'priority'    => 100,
		'default'     => '',
		'choices'     => is_customize_preview()
			? array_merge(
				array(
					'' => __( 'Same as the post page layout', 'snow-monkey' ),
				),
				Helper::get_wrapper_templates()
			)
			: array(),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-page' );
$control = Framework::get_control( 'page-layout' );
$control->join( $section )->join( $panel );
