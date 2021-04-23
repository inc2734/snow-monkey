<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 *
 * renamed: template-parts/common/entries.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => 'rich-media',
		'_excerpt_length' => null,
		'_item_title_tag' => 'h3',
		'_items'          => [],
	]
);

if ( ! $args['_items'] ) {
	return;
}

if ( 'carousel' === $args['_entries_layout'] ) {
	$slug = 'template-parts/common/entries/rss/carousel';
	$args = wp_parse_args(
		$args,
		[
			'_arrows'   => false,
			'_dots'     => true,
			'_interval' => 0,
		]
	);
} else {
	$slug = 'template-parts/common/entries/rss/posts';
	$args = wp_parse_args(
		$args,
		[
			'_infeed_ads'    => false,
			'_force_sm_1col' => false,
		]
	);
}

Helper::get_template_part(
	$slug,
	$args['_name'],
	$args
);
