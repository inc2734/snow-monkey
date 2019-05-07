<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
	return;
}

if ( is_customize_preview() || is_admin() ) {
	return;
}

if ( function_exists( 'tests_add_filter' ) ) {
	return;
}

add_action(
	'inc2734_view_controller_get_template_part_pre_render',
	function( $args ) {
		if ( ! $args['slug'] || 0 === strpos( $args['slug'], 'app/' ) ) {
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
		if ( ! $args['slug'] || 0 === strpos( $args['slug'], 'app/' ) ) {
			return;
		}

		$slug  = $args['slug'];
		$slug .= $args['name'] ? '-' . $args['name'] : '';
		printf( "\n" . '<!-- End : %1$s -->' . "\n", esc_html( $slug ) );
	},
	1
);
