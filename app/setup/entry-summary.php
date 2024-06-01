<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Framework\Helper;

/**
 * Replace excerpt content when post_excerpt is empty
 */
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter(
	'get_the_excerpt',
	function ( $excerpt ) {
		if ( $excerpt ) {
			return $excerpt;
		}
		return Helper::pure_trim_excerpt();
	}
);
