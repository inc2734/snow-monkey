<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.0
 *
 * renamed: app/customizer/layout/sections/singular-post/controls/layout.php
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$post_type_object = get_post_type_object( 'post' );

Framework::control(
	'select',
	'post-layout',
	[
		'label'       => __( 'Page layout', 'snow-monkey' ),
		'description' => sprintf(
			/* translators: 1: Post type label */
			__( 'Select page layout for %1$s page.', 'snow-monkey' ),
			$post_type_object->label
		),
		'priority'    => 100,
		'default'     => 'right-sidebar',
		'choices'     => is_customize_preview() ? Helper::get_wrapper_templates() : [],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-post' );
$control = Framework::get_control( 'post-layout' );
$control->join( $section )->join( $panel );
