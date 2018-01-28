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

	$section = $customizer->get_section( 'category-' . $term->term_id );

	/**
	 * Category accent color
	 */
	$customizer->control( 'color', $term->taxonomy . '-' . $term->term_id . '-accent-color', [
		'label' => sprintf( __( 'Accent color of [ %1$s ] category', 'snow-monkey' ), $term->name ),
	] );

	$control = $customizer->get_control( 'category-' . $term->term_id . '-accent-color' );
	$control->join( $section );

	/**
	 * Category header image
	 */
	$customizer->control( 'image', $term->taxonomy . '-' . $term->term_id . '-header-image', [
		'label' => __( 'Header image', 'snow-monkey' ),
	] );

	$control = $customizer->get_control( $term->taxonomy . '-' . $term->term_id . '-header-image' );
	$control->join( $section );
}
