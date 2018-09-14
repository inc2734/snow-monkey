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
function snow_monkey_get_related_posts_query( $post_id ) {
	$_post = get_post( $post_id );

	if ( ! isset( $_post->ID ) ) {
		return;
	}

	$tax_query = [];

	$taxonomies = get_object_taxonomies( get_post_type( $post_id ), 'object' );
	foreach ( $taxonomies as $taxonomy ) {
		if ( false === $taxonomy->public || false === $taxonomy->show_ui ) {
			continue;
		}

		$term_ids = wp_get_object_terms( $post_id, $taxonomy->name, [ 'fields' => 'ids' ] );
		if ( ! $term_ids ) {
			continue;
		}

		$tax_query[] = [
			'taxonomy' => $taxonomy->name,
			'field'    => 'term_id',
			'terms'    => $term_ids,
			'operator' => 'IN',
		];
	}

	$related_posts_args = [
		'post_type'      => get_post_type( $post_id ),
		'posts_per_page' => 4,
		'orderby'        => 'rand',
		'post__not_in'   => [ $post_id ],
		'tax_query'      => array_merge(
			[
				'relation' => 'AND',
			],
			$tax_query
		),
	];

	$related_posts_args = apply_filters( 'snow_monkey_related_posts_args', $related_posts_args );

	return new WP_Query(
		array_merge(
			$related_posts_args,
			[
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				'suppress_filters'    => true,
			]
		)
	);
}
