<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$_post_type           = get_post_type() ? get_post_type() : 'post';
$eyecatch_position    = get_theme_mod( 'archive-' . $_post_type . '-eyecatch' );
$display_entry_header = 'title-on-page-header' !== $eyecatch_position;
$display_eyecatch     = 'content-top' === $eyecatch_position;
$entries_layout       = get_theme_mod( $_post_type . '-entries-layout' );
$force_sm_1col        = get_theme_mod( $_post_type . '-entries-layout-sm-1col' );

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_archive_top_widget_area' => false,
		'_display_description'             => ! is_paged() && term_description(),
		'_display_entry_header'            => $display_entry_header,
		'_display_eyecatch'                => $display_eyecatch,
		'_entries_layout'                  => $entries_layout,
		'_force_sm_1col'                   => $force_sm_1col,
		'_infeed_ads'                      => false,
	]
);

Helper::get_template_part(
	'template-parts/archive/entry/entry',
	$args['_name'],
	$args
);
