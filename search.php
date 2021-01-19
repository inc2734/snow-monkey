<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
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

$_post_type   = 'any' !== $_post_type ? $_post_type : 'post';
$archive_view = get_theme_mod( $_post_type . '-archive-view' );
$archive_view = $archive_view ? $archive_view : $_post_type;

Controller::layout( get_theme_mod( 'archive-page-layout' ) );
if ( '' === get_search_query() ) {
	Controller::render( 'no-keywords' );
} elseif ( have_posts() ) {
	Controller::render( 'search', $archive_view );
} else {
	Controller::render( 'no-match' );
}
