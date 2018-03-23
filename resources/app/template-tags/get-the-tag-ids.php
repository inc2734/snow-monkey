<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return tag ids of the post
 *
 * @param int $post_id
 * @return array
 */
function snow_monkey_get_the_tag_ids( $post_id ) {
	$tags = get_the_tags( $post_id );
	if ( ! is_array( $tags ) ) {
		return [];
	}

	$tag_ids = [];
	foreach ( $tags as $tag ) {
		$tag_ids[] = $tag->term_id;
	}

	return $tag_ids;
}
