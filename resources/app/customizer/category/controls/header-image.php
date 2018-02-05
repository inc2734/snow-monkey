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
	$section = $customizer->get_section( 'category-' . $term->term_id );

	$customizer->control( 'image', $term->taxonomy . '-' . $term->term_id . '-header-image', [
		'label'    => __( 'Header image', 'snow-monkey' ),
		'priority' => 110,
	] );

	$control = $customizer->get_control( $term->taxonomy . '-' . $term->term_id . '-header-image' );
	$control->join( $section );
}
