<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

add_filter(
	'inc2734_wp_helper_related_posts_args',
	function ( $args ) {
		return apply_filters( 'snow_monkey_related_posts_args', $args );
	}
);
