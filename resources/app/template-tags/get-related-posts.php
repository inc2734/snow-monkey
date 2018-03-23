<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return related posts
 *
 * @param int $post_id
 * @return array
 */
function snow_monkey_get_related_posts( $post_id ) {
	$_post = get_post( $post_id );

	if ( ! isset( $_post->ID ) ) {
		return;
	}

	$tax_query = [];

	$category_ids = snow_monkey_get_the_category_ids( $post_id );
	if ( $category_ids ) {
		$tax_query[] = [
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => $category_ids,
			'operator' => 'IN',
		];
	}

	$tag_ids = snow_monkey_get_the_tag_ids( $post_id );
	if ( $tag_ids ) {
		$tax_query[] = [
			'taxonomy' => 'post_tag',
			'field'    => 'term_id',
			'terms'    => $tag_ids,
			'operator' => 'IN',
		];
	}
	if ( ! $tax_query ) {
		return [];
	}

	$related_posts_args = [
		'post_type'      => get_post_type( $post_id ),
		'posts_per_page' => 4,
		'orderby'        => 'rand',
		'post__not_in'   => [ $post_id ],
		'tax_query'      => array_merge(
			[
				'relation' => 'OR',
			],
			$tax_query
		),
	];
	$related_posts = get_posts( $related_posts_args );

	if ( ! $related_posts ) {
		return [];
	}

	return $related_posts;
}
