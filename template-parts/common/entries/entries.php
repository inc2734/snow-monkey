<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.2.0
 *
 * renamed: template-parts/common/entries.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_entries_id'              => null,
		'_entries_layout'          => 'rich-media',
		'_entries_gap'             => null,
		'_excerpt_length'          => null,
		'_item_thumbnail_size'     => 'medium_large',
		'_item_title_tag'          => 'h2',
		'_display_item_meta'       => true,
		'_display_item_terms'      => 'post' === $args['_name'] ? true : false,
		'_category_label_taxonomy' => null,
		'_use_own_category_label'  => null,
		'_posts_query'             => false,
	)
);

if ( ! $args['_posts_query'] ) {
	return;
}

$_post_type             = get_post_type() ? get_post_type() : 'post';
$archive_view           = get_theme_mod( $_post_type . '-archive-view' );
$display_item_author    = 'post' === $archive_view ? true : get_theme_mod( $_post_type . '-entries-display-item-author' );
$display_item_published = 'post' === $archive_view ? true : get_theme_mod( $_post_type . '-entries-display-item-published' );
$display_item_excerpt   = 'post' === $archive_view ? true : get_theme_mod( $_post_type . '-entries-display-item-excerpt' );

$args = wp_parse_args(
	$args,
	array(
		'_display_item_author'    => $args['_display_item_meta'] && $display_item_author,
		'_display_item_published' => $args['_display_item_meta'] && $display_item_published,
		'_display_item_excerpt'   => $display_item_excerpt,
	)
);

if ( 'carousel' === $args['_entries_layout'] ) {
	$slug = 'template-parts/common/entries/entries/carousel';
	$args = wp_parse_args(
		$args,
		array(
			'_arrows'   => false,
			'_dots'     => true,
			'_interval' => 0,
		)
	);
} else {
	$slug = 'template-parts/common/entries/entries/posts';
	$args = wp_parse_args(
		$args,
		array(
			'_infeed_ads'    => false,
			'_force_sm_1col' => false,
		)
	);
}

Helper::get_template_part(
	$slug,
	$args['_name'],
	$args
);
