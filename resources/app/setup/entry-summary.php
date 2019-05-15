<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

/**
 * Replace excerpt content when post_excerpt is empty
 */
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter(
	'get_the_excerpt',
	function( $excerpt ) {
		if ( $excerpt ) {
			return $excerpt;
		}
		return Helper::pure_trim_excerpt();
	}
);

/**
 * Set excerpt length
 *
 * @param int $length
 * @return int
 */
add_filter(
	'excerpt_length',
	function( $length ) {
		$layout = get_theme_mod( get_post_type() . '-entries-layout' );
		if ( 'rich-media' !== $layout && false !== $layout ) {
			return $length;
		}

		return class_exists( 'multibyte_patch' ) ? 50 : 25;
	},
	99
);
