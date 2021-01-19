<?php
/**
 * Template Name: Full width
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
 */

use Framework\Controller\Controller;

Controller::layout( 'one-column-full' );
if ( is_front_page() ) {
	Controller::render( 'front-page' );
} else {
	Controller::render( 'full', get_post_type() );
}
