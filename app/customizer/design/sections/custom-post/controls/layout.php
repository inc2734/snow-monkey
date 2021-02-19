<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	$custom_post_type_object = get_post_type_object( $custom_post_type );

	Framework::control(
		'select',
		$custom_post_type . '-layout',
		[
			'label'       => __( 'Page layout', 'snow-monkey' ),
			'description' => sprintf(
				/* translators: 1: Post type label */
				__( 'Select page layout for %1$s page.', 'snow-monkey' ),
				$custom_post_type_object->label
			),
			'priority'    => 110,
			'default'     => '',
			'choices'     => is_customize_preview()
				? array_merge(
					[
						'' => __( 'Same as the post page layout', 'snow-monkey' ),
					],
					Helper::get_wrapper_templates()
				)
				: [],
		]
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type );
	$control = Framework::get_control( $custom_post_type . '-layout' );
	$control->join( $section )->join( $panel );
}
