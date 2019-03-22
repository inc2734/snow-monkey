<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Controller\Controller;

$post_type = filter_input( INPUT_GET, 'post_type' );
$post_type = $post_type ? $post_type : 'any';

query_posts(
	[
		'post_type' => $post_type,
	]
);

Controller::layout( get_theme_mod( 'archive-page-layout' ) );
if ( have_posts() ) {
	Controller::render( 'archive', 'search' );
} else {
	Controller::render( 'no-match' );
}
