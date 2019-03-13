<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

$terms = get_terms( [ 'category' ] );
wp_cache_set( 'all-categories', $terms );

if ( ! is_customize_preview() ) {
	return;
}

foreach ( $terms as $_term ) {
	Framework::section(
		'design-category-' . $_term->term_id,
		[
			'title'           => sprintf( __( '[ %1$s ] category pages settings', 'snow-monkey' ), $_term->name ),
			'priority'        => 110,
			'active_callback' => function() use ( $_term ) {
				return is_category( $_term->term_id );
			},
		]
	);
}
