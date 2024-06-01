<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

$taxonomies = Helper::get_taxonomies();
if ( class_exists( '\woocommerce' ) ) {
	unset( $taxonomies['product_cat'] );
	unset( $taxonomies['product_tag'] );
}

if ( ! $taxonomies ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $taxonomies as $taxonomy_name ) {
	$taxonomy_object   = get_taxonomy( $taxonomy_name );
	$custom_post_types = ! empty( $taxonomy_object->object_type ) ? $taxonomy_object->object_type : array();

	$description = '';
	if ( $custom_post_types ) {
		$wp_post_type = get_post_type_object( $custom_post_types[0] );
		if ( ! empty( $wp_post_type->label ) ) {
			$description = sprintf(
					// translators: %1$s: Custom post type label.
				__( 'This setting takes priority over featured image setting of %1$s archive page settings', 'snow-monkey' ),
				$wp_post_type->label
			);
		}
	}

	$terms = Helper::get_terms(
		array(
			'taxonomy'   => $taxonomy_name,
			'hide_empty' => false,
		)
	);

	foreach ( $terms as $_term ) {
		Framework::control(
			'image',
			$_term->taxonomy . '-' . $_term->term_id . '-header-image',
			array(
				'label'       => __( 'Featured Image', 'snow-monkey' ),
				'description' => $description,
				'priority'    => 100,
			)
		);

		$section = Framework::get_section( 'design-' . $_term->taxonomy . '-' . $_term->term_id );
		$control = Framework::get_control( $_term->taxonomy . '-' . $_term->term_id . '-header-image' );
		$control->join( $section )->join( $panel );
	}
}
