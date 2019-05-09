<?php
/**
 * @package kihara
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter(
	'inc2734_wp_breadcrumbs',
	function( $items ) {
		return apply_filters( 'snow_monkey_breadcrumbs', $items );
	},
	9
);
