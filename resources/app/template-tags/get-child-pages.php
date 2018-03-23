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
	return get_children( [
		'post_parent'    => $post_id,
		'post_type'      => 'page',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	] );
}
