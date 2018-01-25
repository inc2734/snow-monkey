<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$post_type = get_post_type();

$controller = new Mimizuku_Controller();
$controller->layout( get_theme_mod( 'archive-page-layout' ) );
if ( have_posts() ) {
	$controller->render( 'archive', $post_type );
} else {
	$controller->render( 'none' );
}
