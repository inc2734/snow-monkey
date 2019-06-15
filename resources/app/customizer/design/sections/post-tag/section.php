<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

$terms = Helper::get_terms( 'post_tag' );

foreach ( $terms as $_term ) {
	Framework::section(
		'design-' . $_term->taxonomy . '-' . $_term->term_id,
		[
			'title' => sprintf(
				/* translators: 1: Tag name */
				__( '[ %1$s ] tag pages settings', 'snow-monkey' ),
				$_term->name
			),
			'priority'        => 110,
			'active_callback' => function() use ( $_term ) {
				return is_tag( $_term->term_id );
			},
		]
	);
}
