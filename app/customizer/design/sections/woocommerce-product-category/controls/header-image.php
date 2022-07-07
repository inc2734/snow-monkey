<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 17.2.2
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

$terms = Helper::get_terms(
	[
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
	]
);

foreach ( $terms as $_term ) {
	Framework::control(
		'image',
		$_term->taxonomy . '-' . $_term->term_id . '-header-image',
		[
			'label'       => __( 'Featured Image', 'snow-monkey' ),
			'description' => __( 'This setting takes priority over featured image setting of WooCommerce products page settings', 'snow-monkey' ),
			'priority'    => 110,
		]
	);
}

$panel = Framework::get_panel( 'design' );

foreach ( $terms as $_term ) {
	$section = Framework::get_section( 'design-' . $_term->taxonomy . '-' . $_term->term_id );
	$control = Framework::get_control( $_term->taxonomy . '-' . $_term->term_id . '-header-image' );
	$control->join( $section )->join( $panel );
}
