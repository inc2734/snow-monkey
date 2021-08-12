<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.0
 */

use Framework\Helper;

$_post_type           = get_post_type() ? get_post_type() : 'post';
$eyecatch_position    = 'post' === $_post_type
	? get_theme_mod( 'archive-eyecatch' )
	: get_theme_mod( 'archive-' . $_post_type . '-eyecatch' );
$display_entry_header = 'title-on-page-header' !== $eyecatch_position;
$display_eyecatch     = 'content-top' === $eyecatch_position;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_archive_top_widget_area' => false,
		'_display_description'             => ! is_paged() && term_description(),
		'_display_entry_header'            => $display_entry_header,
		'_display_eyecatch'                => $display_eyecatch,
	]
);

Helper::get_template_part(
	'template-parts/archive/entry/none',
	null,
	$args
);
