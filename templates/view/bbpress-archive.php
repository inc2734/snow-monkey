<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.7.0
 */

use Framework\Helper;

$eyecatch_position    = get_theme_mod( 'bbpress-archive-eyecatch' );
$display_entry_header = 'title-on-page-header' !== $eyecatch_position;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_entry_header'            => $display_entry_header,
		'_display_archive_top_widget_area' => false,
	]
);

Helper::get_template_part(
	'template-parts/archive/entry/bbpress',
	null,
	$args
);

