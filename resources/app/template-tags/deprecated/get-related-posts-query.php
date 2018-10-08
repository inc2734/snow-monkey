<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

/**
 * Return related posts
 *
 * @deprecated
 *
 * @param int $post_id
 * @return array
 */
function snow_monkey_get_related_posts_query( $post_id ) {
	add_filter(
		'mimizuku_related_posts_args',
		function( $related_posts_args ) {
			return apply_filters( 'snow_monkey_related_posts_args', $related_posts_args );
		}
	);

	return Helper\get_related_posts_query( $post_id );
}
