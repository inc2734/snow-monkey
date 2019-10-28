<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.0.0
 */

use Framework\Helper;

$widget_number = explode( '-', $args['widget_id'] );
if ( 1 < count( $widget_number ) ) {
	array_shift( $widget_number );
	$widget_number = implode( '-', $widget_number );
} else {
	$widget_number = $widget_number[0];
}

$query_args = [
	'post_type'           => ! empty( $instance['post-type'] ) ? $instance['post-type'] : 'post',
	'posts_per_page'      => $instance['posts-per-page'],
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
		'_entries_layout' => $instance['layout'],
		'_title'          => $instance['title'],
		'_link_url'       => $instance['link-url'],
		'_link_text'      => $instance['link-text'],
		'_excerpt_length' => null,
	]
);
echo wp_kses_post( $args['after_widget'] );
