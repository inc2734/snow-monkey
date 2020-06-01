<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.0
 */

use Framework\Helper;

$widget_number = explode( '-', $args['widget_id'] );
if ( 1 < count( $widget_number ) ) {
	array_shift( $widget_number );
	$widget_number = implode( '-', $widget_number );
} else {
	$widget_number = $widget_number[0];
}

$post_types = ! empty( $instance['post-type'] ) ? $instance['post-type'] : 'post';
$post_types = (array) $post_types;

$query_args = [
	'post_type'           => $post_types,
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

$is_multi_cols_pattern = in_array( $instance['layout'], [ 'rich-media', 'panel' ] );
$force_sm_1col = get_theme_mod( $query_args['post_type'][0] . '-entries-layout-sm-1col' );
$force_sm_1col = $is_multi_cols_pattern ? $force_sm_1col : false;

echo wp_kses_post( $args['before_widget'] );
Helper::get_template_part(
	'template-parts/widget/snow-monkey-posts',
	'recent',
	[
		'_posts_query'    => $recent_posts_query,
		'_widget_area_id' => $args['id'],
		'_classname'      => 'snow-monkey-recent-posts',
		'_entries_layout' => $instance['layout'],
		'_force_sm_1col'  => $force_sm_1col,
		'_title'          => $instance['title'],
		'_item_title_tag' => $instance['item-title-tag'],
		'_link_url'       => $instance['link-url'],
		'_link_text'      => $instance['link-text'],
		'_excerpt_length' => null,
	]
);
echo wp_kses_post( $args['after_widget'] );
