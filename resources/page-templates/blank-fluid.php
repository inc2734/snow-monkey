<?php
/**
 * Template Name: Landing page ( has side margins )
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$controller = new Mimizuku_Controller();
$controller->layout( 'blank-fluid' );
$controller->render( 'content-full', get_post_type() );
