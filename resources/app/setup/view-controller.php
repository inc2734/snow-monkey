<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Override inc2734_wp_view_controller_controller
 *
 * @param string $args
 * @return array
 */
add_filter(
	'inc2734_wp_view_controller_controller',
	function( $template, $filename ) {
		return apply_filters( 'snow_monkey_controller', $template, $filename );
	},
	9,
	2
);

/**
 * Override mimizuku_get_template_part_args
 *
 * @param array $args
 *   @param string $slug
 *   @param string $name
 *   @param array $vars
 * @return array
 */
add_filter(
	'mimizuku_get_template_part_args',
	function( $args ) {
		return apply_filters( 'snow_monkey_get_template_part_args', $args );
	},
	9
);

/**
 * Override inc2734_view_controller_get_template_part_{ $slug }
 *
 * @param array $args
 *   @param string $slug
 *   @param string $name
 *   @param array $vars
 */
add_action(
	'inc2734_view_controller_get_template_part_pre_render',
	function( $args ) {
		if ( false !== has_action( 'snow_monkey_get_template_part_' . $args['slug'] ) ) {
			do_action( 'snow_monkey_get_template_part_' . $args['slug'], $args['name'], $args['vars'] );
			add_action( 'inc2734_view_controller_get_template_part_' . $args['slug'], '__return_true' );
		}
	},
	9
);
