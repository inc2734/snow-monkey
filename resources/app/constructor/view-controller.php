<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.8.1
 */

use Framework\Controller\Controller;

new Controller();

/**
 * Update view controller config
 *
 * @param array $config
 * @return array
 */
add_filter(
	'inc2734_wp_view_controller_config',
	function() {
		return [
			'templates' => [
				'',
			],
			'page-templates' => [
				'page-templates',
			],
			'layout' => [
				'templates/layout/wrapper',
			],
			'header' => [
				'templates/layout/header',
			],
			'sidebar' => [
				'templates/layout/sidebar',
			],
			'footer' => [
				'templates/layout/footer',
			],
			'view' => [
				'templates/view',
			],
			'static' => [
				'templates/static',
			],
		];
	}
);

/**
 * If return true, output template debug log
 *
 * @param boolean $debug
 * @return boolean
 */
add_filter(
	'inc2734_wp_view_controller_debug',
	function( $debug ) {
		return apply_filters( 'snow_monkey_debug', $debug );
	}
);

/**
 * Override inc2734_wp_view_controller_controller
 *
 * @param string $template
 * @return array
 */
add_filter(
	'inc2734_wp_view_controller_controller',
	function( $template ) {
		return apply_filters( 'snow_monkey_controller', $template );
	},
	9
);

/**
 * Change root directory of get_template_part().
 * If return empty, root is theme directory (= default get_template_part()).
 *
 * @param string $root
 * @param string $slug
 * @param string $name
 * @param array $vars
 */
add_filter(
	'inc2734_wp_view_controller_template_part_root',
	function( $root, $slug, $name, $vars ) {
		return apply_filters( 'snow_monkey_template_part_root', $root, $slug, $name, $vars );
	},
	10,
	4
);

/**
 * Change root directory of get_template_part().
 * If return empty, root is theme directory (= default get_template_part()).
 *
 * @param array $hierarchy
 * @param string $slug
 * @param string $name
 * @param array $vars
 */
add_filter(
	'inc2734_wp_view_controller_template_part_root_hierarchy',
	function( $hierarchy, $slug, $name, $vars ) {
		return apply_filters( 'snow_monkey_template_part_root_hierarchy', $hierarchy, $slug, $name, $vars );
	},
	10,
	4
);

/**
 * Override inc2734_wp_view_controller_get_template_part_args
 *
 * @param array $args
 *   @param string $slug
 *   @param string $name
 *   @param array $vars
 * @return array
 */
add_filter(
	'inc2734_wp_view_controller_get_template_part_args',
	function( $args ) {
		return apply_filters( 'snow_monkey_get_template_part_args', $args );
	},
	9
);

/**
 * Override inc2734_wp_view_controller_get_template_part_{ $slug }
 *
 * @deprecated
 *
 * @param array $args
 *   @param string $slug
 *   @param string $name
 *   @param array $vars
 */
add_action(
	'inc2734_wp_view_controller_get_template_part_pre_render',
	function( $args ) {
		$target_slug = $args['slug'];
		$target_name = $args['name'];

		$action           = 'snow_monkey_get_template_part_' . $target_slug;
		$action_with_name = 'snow_monkey_get_template_part_' . $target_slug . '-' . $target_name;

		if ( $target_name && has_action( $action_with_name ) ) {
			add_filter(
				'inc2734_wp_view_controller_template_part_render',
				function( $html, $slug, $name, $vars ) use ( $action_with_name, $target_slug, $target_name ) {
					if ( $target_slug === $slug && $target_name === $name ) {
						ob_start();
						do_action( $action_with_name, $vars );
						return ob_get_clean();
					}
					return $html;
				},
				1,
				4
			);
			return;
		}

		if ( has_action( $action ) ) {
			add_filter(
				'inc2734_wp_view_controller_template_part_render',
				function( $html, $slug, $name, $vars ) use ( $action, $target_slug ) {
					if ( $target_slug === $slug ) {
						ob_start();
						do_action( $action, $name, $vars );
						return ob_get_clean();
					}
					return $html;
				},
				1,
				4
			);
			return;
		}
	},
	9
);

/**
 * Override inc2734_wp_view_controller_template_part_render
 *
 * @param string $slug
 * @param string $name
 * @param array $vars
 * @return array
 */
add_filter(
	'inc2734_wp_view_controller_template_part_render',
	function( $html, $slug, $name, $vars ) {
		return apply_filters( 'snow_monkey_template_part_render', $html, $slug, $name, $vars );
	},
	9,
	4
);
