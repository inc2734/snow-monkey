<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.2.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

$terms = Helper::get_terms(
	array(
		'taxonomy'   => 'category',
		'hide_empty' => false,
	)
);

$panel = Framework::get_panel( 'design' );

foreach ( $terms as $_term ) {
	Framework::control(
		'checkbox',
		$_term->taxonomy . '-' . $_term->term_id . '-use-own-category-label',
		array(
			'label'       => __( 'Use the category label set for itself', 'snow-monkey' ),
			'description' => __( 'By default, category labels are displayed according to the current archive page', 'snow-monkey' ),
			'priority'    => 120,
			'default'     => false,
		)
	);

	$section = Framework::get_section( 'design-' . $_term->taxonomy . '-' . $_term->term_id );
	$control = Framework::get_control( $_term->taxonomy . '-' . $_term->term_id . '-use-own-category-label' );
	$control->join( $section )->join( $panel );
}
