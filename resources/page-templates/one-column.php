<?php
/**
 * Template Name: One column
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Controller\Controller;

Controller::layout( 'one-column' );
if ( is_front_page() ) {
	Controller::render( 'front-page' );
} else {
	Controller::render( 'content', get_post_type() );
}
