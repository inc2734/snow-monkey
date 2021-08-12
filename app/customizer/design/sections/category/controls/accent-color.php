<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$terms = Helper::get_terms(
	[
		'taxonomy'   => 'category',
		'hide_empty' => false,
	]
);

foreach ( $terms as $_term ) {
	Framework::control(
		'color',
		$_term->taxonomy . '-' . $_term->term_id . '-accent-color',
		[
			'label'    => __( 'Accent color', 'snow-monkey' ),
			'priority' => 100,
		]
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $terms as $_term ) {
	$section = Framework::get_section( 'design-' . $_term->taxonomy . '-' . $_term->term_id );
	$control = Framework::get_control( $_term->taxonomy . '-' . $_term->term_id . '-accent-color' );
	$control->join( $section )->join( $panel );
}
