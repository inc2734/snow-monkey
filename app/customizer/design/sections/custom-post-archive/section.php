<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.0.0-rc1
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;
use Framework\Controller\Controller;

if ( ! is_customize_preview() ) {
	return;
}

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	$custom_post_type_object = get_post_type_object( $custom_post_type );

	Framework::section(
		'design-' . $custom_post_type . '-archive',
		array(
			'title'           => sprintf(
				/* translators: 1: Custom post type name */
				__( '%1$s archive page settings', 'snow-monkey' ),
				$custom_post_type_object->label
			),
			'priority'        => 130,
			'active_callback' => function() use ( $custom_post_type ) {
				$queried_object = get_queried_object();
				$queried_object = is_object( $queried_object ) ? clone $queried_object : $queried_object;
				if ( is_a( $queried_object, 'WP_Term' ) ) {
					$taxonomy = get_taxonomy( $queried_object->taxonomy );
					if ( $taxonomy ) {
						$object_types = $taxonomy->object_type;
					}
				}

				$view = Controller::get_view();
				$view = explode( '/', $view['slug'] );
				if ( ! $view ) {
					return false;
				}

				$view = $view[ count( $view ) - 1 ];

				return in_array( $view, array( 'archive', 'none' ), true )
						&& (
							is_post_type_archive( $custom_post_type )
							|| (
								isset( $object_types )
								&& in_array( $custom_post_type, $object_types, true )
								&& is_tax( $taxonomy->name )
							)
						);
			},
		)
	);
}
