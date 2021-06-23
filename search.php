<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 */

use Framework\Controller\Controller;

global $wp_query;

$_post_type = $wp_query->get( 'post_type' );
$_post_type = $_post_type ? $_post_type : 'any';

query_posts(
	array_merge(
		$wp_query->query,
		[
			'post_type' => $_post_type,
		]
	)
);

$_post_type = 'any' !== $_post_type ? $_post_type : 'any';
$_post_type = ! is_array( $_post_type ) ? $_post_type : 'any';

$layout = get_theme_mod( 'archive-' . $_post_type . '-layout' );
$layout = $layout ? $layout : get_theme_mod( 'archive-post-layout' );

Controller::layout( $layout );
if ( '' === get_search_query() ) {
	Controller::render( 'no-keywords' );
} elseif ( have_posts() ) {
	$archive_view = get_theme_mod( $_post_type . '-archive-view' );
	$archive_view = $archive_view ? $archive_view : $_post_type;

	Controller::render( 'search', $archive_view );
} else {
	Controller::render( 'no-match' );
}
