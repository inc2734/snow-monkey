<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.0
 */

use Framework\Controller\Controller;

$_post_type = get_post_type();
if ( is_post_type_archive() ) {
	$_post_type = $_post_type ? $_post_type : get_query_var( 'post_type' );
} elseif ( is_tax() ) {
	$term       = get_queried_object();
	$taxonomy   = get_taxonomy( $term->taxonomy );
	$_post_type = $taxonomy->object_type[0];
}
$_post_type = $_post_type ? $_post_type : 'post';

$layout = get_theme_mod( 'archive-' . $_post_type . '-layout' );
$layout = $layout ? $layout : get_theme_mod( 'archive-post-layout' );

Controller::layout( $layout );
if ( have_posts() ) {
	$archive_view = get_theme_mod( $_post_type . '-archive-view' );
	$archive_view = $archive_view ? $archive_view : $_post_type;

	Controller::render( 'archive', $archive_view );
} else {
	Controller::render( 'none' );
}
