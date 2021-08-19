<?php
/**
 * Template Name: Right sidebar
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.5
 */

use Framework\Controller\Controller;

Controller::layout( 'right-sidebar' );
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
	$content_view = $content_view ? $content_view : $_post_type;

	Controller::render( 'content', $content_view );
}
