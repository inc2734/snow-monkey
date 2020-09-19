<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

/**
 * Change root directory of wp-awesome-widgets.
 *
 * @param array $hierarchy
 * @param string $slug
 * @param string $name
 * @param array $vars
 */
add_filter(
	'inc2734_wp_awesome_widgets_view_hierarchy',
	function( $hierarchy, $slug, $name, $vars ) {
		return apply_filters( 'snow_monkey_wp_awesome_widgets_view_hierarchy', $hierarchy, $slug, $name, $vars );
	},
	10,
	4
);

/**
 * Override inc2734_wp_awesome_widgets_view_args
 *
 * @param array $args
 *   @param string $slug
 *   @param string $name
 *   @param array $vars
 * @return array
 */
add_filter(
	'inc2734_wp_awesome_widgets_view_args',
	function( $args ) {
		return apply_filters( 'snow_monkey_wp_awesome_widgets_view_args', $args );
	},
	9
);

/**
 * Override inc2734_wp_awesome_widgets_view_{ $slug }
 *
 * @param array $args
 *   @param string $slug
 *   @param string $name
 *   @param array $vars
 */
add_action(
	'inc2734_wp_awesome_widgets_view_pre_render',
	function( $args ) {
		$slug = $args['slug'];
		$name = $args['name'];

		$action           = 'snow_monkey_wp_awesome_widgets_view_' . $slug;
		$action_with_name = 'snow_monkey_wp_awesome_widgets_view_' . $slug . '-' . $name;

		if ( $name && has_action( $action_with_name ) ) {
			add_action(
				'inc2734_wp_awesome_widgets_view_' . $slug . '-' . $name,
				function( $vars ) use ( $action_with_name ) {
					do_action( $action_with_name, $vars );
				}
			);
			return;
		}

		if ( has_action( $action ) ) {
			add_action(
				'inc2734_wp_awesome_widgets_view_' . $slug,
				function( $name, $vars ) use ( $action ) {
					do_action( $action, $name, $vars );
				},
				10,
				2
			);
			return;
		}
	},
	9
);

/**
 * Override inc2734_wp_awesome_widgets_view_render
 *
 * @param string $slug
 * @param string $name
 * @param array $vars
 * @return array
 */
add_filter(
	'inc2734_wp_awesome_widgets_view_render',
	function( $html, $slug, $name, $vars ) {
		return apply_filters( 'snow_monkey_wp_awesome_widgets_view_render', $html, $slug, $name, $vars );
	},
	9,
	4
);
