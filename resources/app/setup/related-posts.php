<?php
/**
 * @package kihara
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter(
	'mimizuku_related_posts_args',
	function( $args ) {
		return apply_filters( 'snow_monkey_related_posts_args', $args );
	}
);
