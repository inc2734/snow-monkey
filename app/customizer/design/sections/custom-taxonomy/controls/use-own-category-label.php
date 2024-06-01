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

	$terms = Helper::get_terms(
		array(
			'taxonomy'   => $taxonomy_name,
			'hide_empty' => false,
		)
	);

	foreach ( $terms as $_term ) {
		Framework::control(
			'checkbox',
			$_term->taxonomy . '-' . $_term->term_id . '-use-own-category-label',
			array(
				'label'           => __( 'Use the category label set for itself', 'snow-monkey' ),
				'description'     => __( 'By default, category labels are displayed according to the current archive page', 'snow-monkey' ),
				'priority'        => 110,
				'active_callback' => function () use ( $_term ) {
					return is_taxonomy_hierarchical( $_term->taxonomy );
				},
			)
		);

		$section = Framework::get_section( 'design-' . $_term->taxonomy . '-' . $_term->term_id );
		$control = Framework::get_control( $_term->taxonomy . '-' . $_term->term_id . '-use-own-category-label' );
		$control->join( $section )->join( $panel );
	}
}
