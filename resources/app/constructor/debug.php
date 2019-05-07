<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG || is_customize_preview() || function_exists( 'tests_add_filter' ) ) {
	return;
}

add_action(
	'inc2734_view_controller_get_template_part_pre_render',
	function( $args ) {
		if ( ! $args['slug'] ) {
			return;
		}

		$slug  = $args['slug'];
		$slug .= $args['name'] ? '-' . $args['name'] : '';
		printf( "\n" . '<!-- Start : %1$s -->' . "\n", esc_html( $slug ) );
	},
	1
);

add_action(
	'inc2734_view_controller_get_template_part_post_render',
	function( $args ) {
		if ( ! $args['slug'] ) {
			return;
		}

		$slug  = $args['slug'];
		$slug .= $args['name'] ? '-' . $args['name'] : '';
		printf( "\n" . '<!-- End : %1$s -->' . "\n", esc_html( $slug ) );
	},
	1
);
