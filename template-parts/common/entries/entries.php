<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
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
		'_excerpt_length'          => null,
		'_item_thumbnail_size'     => 'medium_large',
		'_item_title_tag'          => 'h2',
		'_display_item_meta'       => 'post' === $args['_name'] ? true : false,
		'_display_item_terms'      => 'post' === $args['_name'] ? true : false,
		'_category_label_taxonomy' => null,
		'_posts_query'             => false,
	)
);

if ( ! $args['_posts_query'] ) {
	return;
}

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
