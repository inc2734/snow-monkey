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
	$section    = $customizer->get_section( 'category-' . $term->term_id );

	$customizer->control( 'color', $term->taxonomy . '-' . $term->term_id . '-accent-color', [
		'label'    => __( 'Accent color', 'snow-monkey' ),
		'priority' => 100,
	] );

	$control = $customizer->get_control( 'category-' . $term->term_id . '-accent-color' );
	$control->join( $section )->join( $panel );
}
