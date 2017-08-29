<?php
/**
 * Template Name: One column (fluid)
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$controller = new Mimizuku_Controller();
$controller->layout( 'one-column-fluid' );
$controller->render( 'content', get_post_type() );
