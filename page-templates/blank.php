<?php
/**
 * Template Name: Landing page
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Framework\Controller\Controller;

Controller::layout( 'blank' );
if ( is_front_page() ) {
	Controller::render( 'front-page' );
} elseif ( is_home() ) {
	if ( have_posts() ) {
		Controller::render( 'home' );
	} else {
		Controller::render( 'home-none' );
	}
} else {
	$_post_type = get_post_type();

	$content_view = get_theme_mod( $_post_type . '-view' );
	$slug         = in_array( $content_view, array( 'post', 'page' ), true ) ? 'content' : 'full';
	$content_view = $content_view ? $content_view : $_post_type;

	Controller::render( $slug, $content_view );
}
