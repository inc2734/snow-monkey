<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

add_filter(
	'inc2734_wp_helper_child_pages_args',
	function( $args ) {
		return apply_filters( 'snow_monkey_child_pages_args', $args );
	}
);
