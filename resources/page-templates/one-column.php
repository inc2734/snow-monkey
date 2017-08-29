<?php
/**
 * Template Name: One column
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$controller = new Mimizuku_Controller();
$controller->layout( 'one-column' );
$controller->render( 'content', get_post_type() );
