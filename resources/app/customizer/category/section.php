<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$terms = get_terms( [ 'category' ] );
foreach ( $terms as $term ) {
	$customizer->section( 'category-' . $term->term_id, [
		'title'           => sprintf( __( '[ %1$s ] category settings', 'snow-monkey' ), $term->name ),
		'priority'        => 1110,
		'active_callback' => function() use ( $term ) {
			return is_category( $term->term_id );
		},
	] );
}
