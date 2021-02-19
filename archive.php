<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.0
 */

use Framework\Controller\Controller;

$_post_type = get_post_type() ? get_post_type() : 'post';

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
