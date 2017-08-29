<?php
/**
 * Template Name: Right sidebar
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$controller = new Mimizuku_Controller();
$controller->layout( 'right-sidebar' );
$controller->render( 'content', get_post_type() );
