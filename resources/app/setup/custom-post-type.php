<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter(
	'snow_monkey_get_template_part_args',
	function( $args ) {
		if ( ! is_singular() ) {
			return $args;
		}

		$custom_post_type = get_post_type();
		$custom_post_view = get_theme_mod( $custom_post_type . '-view' );
		if ( ! $custom_post_view ) {
			return $args;
		}

		if ( 'templates/view/content' !== $args['slug'] || $custom_post_type !== $args['name'] ) {
			return $args;
		}

		$args['name'] = $custom_post_view;
		return $args;
	},
	9
);
