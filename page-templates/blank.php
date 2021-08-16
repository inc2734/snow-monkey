<?php
/**
 * Template Name: Landing page
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.2
 */

use Framework\Controller\Controller;

Controller::layout( 'blank' );
if ( is_front_page() ) {
	Controller::render( 'front-page' );
} else {
	$_post_type = get_post_type();

	$content_view = get_theme_mod( $_post_type . '-view' );
	$content_view = $content_view ? $content_view : $_post_type;
	$slug         = in_array( $content_view, [ 'post', 'page' ], true ) ? 'content' : 'full';

	Controller::render( $slug, $content_view );
}
