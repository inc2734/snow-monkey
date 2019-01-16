<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

$terms = wp_cache_get( 'all-categories' );

foreach ( $terms as $_term ) {
	Framework::control(
		'image',
		$_term->taxonomy . '-' . $_term->term_id . '-header-image',
		[
			'label'    => __( 'Header image', 'snow-monkey' ),
			'priority' => 110,
		]
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $terms as $_term ) {
	$section = Framework::get_section( 'category-' . $_term->term_id );
	$control = Framework::get_control( $_term->taxonomy . '-' . $_term->term_id . '-header-image' );
	$control->join( $section )->join( $panel );
}
