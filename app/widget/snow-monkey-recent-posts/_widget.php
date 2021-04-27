<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 */

use Framework\Helper;

$widget_args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$widget_args,
	// phpcs:enable
	[]
);

if ( ! $widget_args ) {
	return;
}

$instance = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$instance,
	// phpcs:enable
	[]
);

if ( ! $instance ) {
	return;
}

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	isset( $args ) ? $args : [],
	// phpcs:enable
	[
		'_context' => 'snow-monkey/widget/recent-posts',
	]
);

$widget_number = explode( '-', $widget_args['widget_id'] );
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
	'suppress_filters'    => false,
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

$is_multi_cols_pattern = in_array( $instance['layout'], [ 'rich-media', 'panel' ], true );
$force_sm_1col         = $instance['force-sm-1col'];
$force_sm_1col         = 0 === $force_sm_1col || 1 === $force_sm_1col ? $force_sm_1col : false;
$force_sm_1col         = false === $force_sm_1col && $is_multi_cols_pattern
	? get_theme_mod( $query_args['post_type'][0] . '-entries-layout-sm-1col' )
	: $force_sm_1col;

echo wp_kses_post( $widget_args['before_widget'] );
Helper::get_template_part(
	'template-parts/widget/snow-monkey-posts',
	'recent',
	[
		'_classname'           => 'snow-monkey-recent-posts',
		'_context'             => $args['_context'],
		'_entries_layout'      => $instance['layout'],
		'_excerpt_length'      => null,
		'_force_sm_1col'       => $force_sm_1col,
		'_item_thumbnail_size' => $instance['item-thumbnail-size'],
		'_item_title_tag'      => $instance['item-title-tag'],
		'_display_item_meta'   => $instance['display-item-meta'],
		'_display_item_terms'  => $instance['display-item-terms'],
		'_link_text'           => $instance['link-text'],
		'_link_url'            => $instance['link-url'],
		'_posts_query'         => $recent_posts_query,
		'_title'               => $instance['title'],
		'_widget_area_id'      => $widget_args['id'],
		'_arrows'              => $instance['arrows'],
		'_dots'                => $instance['dots'],
		'_interval'            => $instance['interval'],
	]
);
echo wp_kses_post( $widget_args['after_widget'] );
