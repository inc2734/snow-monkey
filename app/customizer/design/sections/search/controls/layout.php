<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_search_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	$custom_post_type_object = 'any' !== $custom_post_type
		? get_post_type_object( $custom_post_type )
		: false;

	Framework::control(
		'select',
		'search-' . $custom_post_type . '-layout',
		array(
			'label'       => __( 'Page layout', 'snow-monkey' ),
			'description' => sprintf(
				/* translators: 1: archive */
				__( 'Select page layout for %1$s page.', 'snow-monkey' ),
				sprintf(
					/* translators: 1: Custom post type label */
					__( '%1$s search resulsts', 'snow-monkey' ),
					$custom_post_type_object ? $custom_post_type_object->label : __( 'Basic', 'snow-monkey' )
				)
			),
			'priority'    => 110,
			'default'     => '',
			'choices'     => is_customize_preview()
				? array_merge(
					array(
						'' => sprintf(
							/* translators: 1: Custom post type label */
							__( 'Same as the %1$s archive page layout', 'snow-monkey' ),
							strtolower( $custom_post_type_object ? $custom_post_type_object->label : __( 'post', 'snow-monkey' ) )
						),
					),
					Helper::get_wrapper_templates()
				)
				: array(),
		)
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type . '-search' );
	$control = Framework::get_control( 'search-' . $custom_post_type . '-layout' );
	$control->join( $section )->join( $panel );
}
