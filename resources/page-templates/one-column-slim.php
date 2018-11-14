<?php
/**
 * Template Name: One column ( slim width )
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\App\Controller\Controller;

Controller::layout( 'one-column-slim' );
if ( is_front_page() ) {
	Controller::render( 'front-page' );
} else {
	Controller::render( 'content', get_post_type() );
}
