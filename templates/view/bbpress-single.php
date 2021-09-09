<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.7.0
 */

use Framework\Helper;

$eyecatch_position    = get_theme_mod( 'bbpress-single-eyecatch' );
$display_entry_header = 'title-on-page-header' !== $eyecatch_position;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_article_bottom_widget_area'  => false,
		'_display_article_top_widget_area'     => false,
		'_display_contents_bottom_widget_area' => false,
		'_display_entry_header'                => $display_entry_header,
	]
);

if ( $args['_display_entry_header'] ) {
	$args = wp_parse_args(
		$args,
		[
			'_display_title_top_widget_area' => false,
		]
	);
}

Helper::get_template_part(
	'template-parts/content/entry/bbpress',
	null,
	$args
);

