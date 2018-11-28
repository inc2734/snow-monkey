<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

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
		return \Inc2734\Mimizuku_Core\Helper\pure_trim_excerpt();
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
		if ( 'rich-media' !== get_theme_mod( 'archive-layout' ) ) {
			return $length;
		}

		if ( class_exists( 'multibyte_patch' ) ) {
			return 50;
		}

		return 25;
	},
	99
);
