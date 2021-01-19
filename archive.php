<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
 */

use Framework\Controller\Controller;

$_post_type   = get_post_type() ? get_post_type() : 'post';
$archive_view = get_theme_mod( $_post_type . '-archive-view' );
$archive_view = $archive_view ? $archive_view : $_post_type;

Controller::layout( get_theme_mod( 'archive-page-layout' ) );
if ( have_posts() ) {
	Controller::render( 'archive', $archive_view );
} else {
	Controller::render( 'none' );
}
