<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;
use Framework\Controller\Controller;

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

$terms = Helper::get_terms(
	[
		'taxonomy'   => $taxonomies,
		'hide_empty' => false,
	]
);

foreach ( $terms as $_term ) {
	Framework::section(
		'design-' . $_term->taxonomy . '-' . $_term->term_id,
		[
			'title'           => sprintf(
				/* translators: 1: Taxonomy name */
				__( '[ %1$s ] taxonomy pages settings', 'snow-monkey' ),
				$_term->name
			),
			'priority'        => 131,
			'active_callback' => function() use ( $_term ) {
				return in_array( Controller::get_view(), [ 'archive', 'none' ], true )
						&& is_tax( $_term->taxonomy, $_term->term_id );
			},
		]
	);
}
