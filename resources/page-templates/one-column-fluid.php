<?php
/**
 * Template Name: One column (fluid)
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$controller = new Mimizuku_Controller();
$controller->layout( 'one-column-fluid' );
if ( is_front_page() ) {
	$controller->render( 'front-page' );
} else {
	$controller->render( 'content', get_post_type() );
}
