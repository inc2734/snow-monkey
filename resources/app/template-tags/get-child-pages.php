<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return the child pages
 *
 * @var int $post_id
 * @return array
 */
function snow_monkey_get_child_pages( $post_id ) {
	return new WP_Query(
		[
			'post_parent'    => $post_id,
			'post_type'      => 'page',
			'posts_per_page' => 100,
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		]
	);
}
