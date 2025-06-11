<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;
use Framework\Controller\Controller;

if ( ! is_customize_preview() ) {
	return;
}

$custom_post_types = Helper::get_search_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	$custom_post_type_object = 'any' !== $custom_post_type
		? get_post_type_object( $custom_post_type )
		: false;

	Framework::section(
		'design-' . $custom_post_type . '-search',
		array(
			'title'           => sprintf(
				/* translators: 1: Custom post type name */
				__( '%1$s search results page settings', 'snow-monkey' ),
				$custom_post_type_object ? $custom_post_type_object->label : __( 'Basic', 'snow-monkey' )
			),
			'priority'        => 140,
			'active_callback' => function () use ( $custom_post_type ) {
				$_post_type = Helper::get_post_type_for_search();

				return Helper::is_search() && $custom_post_type === $_post_type;
			},
		)
	);
}
