<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.0.0
 */

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
				'vendor/inc2734/mimizuku-core/src/view/templates/view',
			],
			'static' => [
				'templates/static',
			],
		];
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
	'mimizuku_template_part_root',
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
	'mimizuku_template_part_root_hierarchy',
	function( $hierarchy, $slug, $name, $vars ) {
		return apply_filters( 'snow_monkey_template_part_root_hierarchy', $hierarchy, $slug, $name, $vars );
	},
	10,
	4
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
 * Override inc2734_wp_view_controller_get_template_part_{ $slug }
 *
 * @param array $args
 *   @param string $slug
 *   @param string $name
 *   @param array $vars
 */
add_action(
	'inc2734_wp_view_controller_get_template_part_pre_render',
	function( $args ) {
		$slug = $args['slug'];
		$name = $args['name'];

		$action           = 'snow_monkey_get_template_part_' . $slug;
		$action_with_name = 'snow_monkey_get_template_part_' . $slug . '-' . $name;

		if ( $name && has_action( $action_with_name ) ) {
			add_action(
				'inc2734_wp_view_controller_get_template_part_' . $slug . '-' . $name,
				function( $vars ) use ( $slug, $name, $action_with_name ) {
					do_action( $action_with_name, $vars );
				}
			);
			return;
		}

		if ( has_action( $action ) ) {
			add_action(
				'inc2734_wp_view_controller_get_template_part_' . $slug,
				function( $name, $vars ) use ( $slug, $action ) {
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
 * Override mimizuku_template_part_render
 *
 * @param string $slug
 * @param string $name
 * @param array $vars
 * @return array
 */
add_filter(
	'mimizuku_template_part_render',
	function( $html, $slug, $name, $vars ) {
		return apply_filters( 'snow_monkey_template_part_render', $html, $slug, $name, $vars );
	},
	9,
	4
);
