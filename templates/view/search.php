<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 *
 * renamed: templates/view/archive-search.php
 */

use Framework\Helper;

global $wp_query;

$_post_type     = $wp_query->get( 'post_type' );
$_post_type     = $_post_type ? $_post_type : 'any';
$entries_layout = get_theme_mod( $_post_type . '-entries-layout' );
$force_sm_1col  = get_theme_mod( $_post_type . '-entries-layout-sm-1col' );

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => $entries_layout,
		'_force_sm_1col'  => $force_sm_1col,
	]
);

Helper::get_template_part(
	'template-parts/archive/entry/search',
	$args['_name'],
	[
		'_entries_layout' => $args['_entries_layout'],
		'_force_sm_1col'  => $args['_force_sm_1col'],
	]
);
