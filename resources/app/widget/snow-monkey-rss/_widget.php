<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

use Framework\Helper;

$widget_number = explode( '-', $args['widget_id'] );
if ( 1 < count( $widget_number ) ) {
	array_shift( $widget_number );
	$widget_number = implode( '-', $widget_number );
} else {
	$widget_number = $widget_number[0];
}

$rss = fetch_feed( $instance['feed-url'] );
if ( is_wp_error( $rss ) || ! $rss->get_item_quantity() ) {
	return;
}

$is_multi_cols_pattern = in_array( $instance['layout'], [ 'rich-media', 'panel' ] );
$force_sm_1col = $instance['force-sm-1col'];
$force_sm_1col = 0 === $force_sm_1col || 1 === $force_sm_1col ? $force_sm_1col : false;
$force_sm_1col = false === $force_sm_1col && $is_multi_cols_pattern
	? get_theme_mod( 'post-entries-layout-sm-1col' )
	: $force_sm_1col;

echo wp_kses_post( $args['before_widget'] );
Helper::get_template_part(
	'template-parts/widget/snow-monkey-rss',
	null,
	[
		'_items'          => $rss->get_items( 0, $instance['posts-per-page'] ),
		'_widget_area_id' => $args['id'],
		'_classname'      => 'snow-monkey-rss',
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
