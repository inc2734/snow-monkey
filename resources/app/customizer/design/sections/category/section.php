<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'design' );

$terms = get_terms( [ 'category' ] );
foreach ( $terms as $term ) {
	$customizer->section( 'category-' . $term->term_id, [
		'title'           => __( 'Page settings', 'snow-monkey' ),
		'description'     => __( 'By the type of page displayed on the preview screen on the right side of the screen, the display setting items switched.', 'snow-monkey' ) . sprintf( __( 'Currently [ %1$s ] category settings is displayed.', 'snow-monkey' ), $term->name ),
		'priority'        => 110,
		'active_callback' => function() use ( $term ) {
			return is_category( $term->term_id );
		},
	] );
}
