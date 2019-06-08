<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <unversion>
 */

use Framework\Helper;

$widget_number = explode( '-', $args['widget_id'] );
$widget_number = end( $widget_number );

$has_sticky   = get_option( 'sticky_posts' ) && ! $instance['ignore-sticky-posts'];
$sticky_count = 0;
if ( $has_sticky ) {
	foreach ( get_option( 'sticky_posts' ) as $_post_id ) {
		if ( 'publish' === get_post_status( $_post_id ) ) {
			$sticky_count ++;
		}
	}
}

$query_args = [
	'post_type'           => ! empty( $instance['post-type'] ) ? $instance['post-type'] : 'post',
	'posts_per_page'      => $instance['posts-per-page'] - $sticky_count,
	'ignore_sticky_posts' => $instance['ignore-sticky-posts'],
	'suppress_filters'    => true,
];
$query_args = apply_filters( 'snow_monkey_recent_posts_widget_args', $query_args );
$query_args = apply_filters( 'snow_monkey_recent_posts_widget_args_' . $widget_number, $query_args );

$recent_posts_query = new WP_Query(
	array_merge(
		$query_args,
		[
			'no_found_rows' => true,
		]
	)
);

if ( ! $recent_posts_query->have_posts() ) {
	return;
}

echo wp_kses_post( $args['before_widget'] );
Helper::get_template_part(
	'template-parts/widget/snow-monkey-posts',
	'recent',
	[
		'_posts_query'    => $recent_posts_query,
		'_widget_area_id' => $args['id'],
		'_classname'      => 'snow-monkey-recent-posts',
		'_id'             => $args['widget_id'],
		'_entries_layout' => $instance['layout'],
		'_title'          => $instance['title'],
		'_link_url'       => $instance['link-url'],
		'_link_text'      => $instance['link-text'],
	]
);
echo wp_kses_post( $args['after_widget'] );
