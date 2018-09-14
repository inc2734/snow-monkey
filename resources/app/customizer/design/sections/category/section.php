<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$terms = get_terms( [ 'category' ] );
wp_cache_set( 'all-categories', $terms );

if ( ! is_customize_preview() ) {
	return;
}

$customizer = Customizer_Framework::init();

foreach ( $terms as $_term ) {
	$customizer->section(
		'category-' . $_term->term_id,
		[
			'title'           => __( 'Page settings', 'snow-monkey' ),
			'description'     => __( 'By the type of page displayed on the preview screen on the right side of the screen, the display setting items switched.', 'snow-monkey' ) . sprintf( __( 'Currently [ %1$s ] category settings is displayed.', 'snow-monkey' ), $_term->name ),
			'priority'        => 110,
			'active_callback' => function() use ( $_term ) {
				return is_category( $_term->term_id );
			},
		]
	);
}
