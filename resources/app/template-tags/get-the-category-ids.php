<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return category ids of the post
 *
 * @param int $post_id
 * @return array
 */
function snow_monkey_get_the_category_ids( $post_id ) {
	$categories = get_the_category( $post_id );
	if ( ! is_array( $categories ) ) {
		return [];
	}

	$category_ids = [];
	foreach ( $categories as $category ) {
		$category_ids[] = $category->term_id;
	}

	return $category_ids;
}
