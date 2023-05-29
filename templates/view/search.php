<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.1
 *
 * renamed: templates/view/archive-search.php
 */

use Framework\Helper;

global $wp_query;

$_post_type     = $wp_query->get( 'post_type' );
$_post_type     = $_post_type ? $_post_type : 'any';
$_post_type     = 'any' !== $_post_type ? $_post_type : 'post';
$_post_type     = is_array( $_post_type ) ? $_post_type[0] : $_post_type;
$entries_layout = get_theme_mod( $_post_type . '-entries-layout' );
$entries_gap    = get_theme_mod( $_post_type . '-entries-gap' );
$force_sm_1col  = get_theme_mod( $_post_type . '-entries-layout-sm-1col' );

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_entries_layout' => $entries_layout,
		'_entries_gap'    => $entries_gap,
		'_force_sm_1col'  => $force_sm_1col,
	)
);

Helper::get_template_part(
	'template-parts/archive/entry/search',
	$args['_name'],
	array(
		'_entries_layout' => $args['_entries_layout'],
		'_entries_gap'    => $args['_entries_gap'],
		'_force_sm_1col'  => $args['_force_sm_1col'],
	)
);
