<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.0
 */

use Framework\Helper;

$eyecatch_position    = get_theme_mod( 'archive-eyecatch' );
$display_entry_header = ! is_front_page()
												&& get_theme_mod( 'posts-page-display-title' )
												&& 'title-on-page-header' !== $eyecatch_position;
$display_eyecatch     = 'content-top' === $eyecatch_position;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_entry_header'                  => $display_entry_header,
		'_display_eyecatch'                      => $display_eyecatch,
		'_display_posts_page_top_widget_area'    => ! is_paged(),
		'_display_posts_page_bottom_widget_area' => ! is_paged(),
	]
);

Helper::get_template_part(
	'template-parts/archive/entry/home-none',
	null,
	$args
);
