<?php
/**
 * Template Name: Landing page
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.1
 */

use Framework\Controller\Controller;

$_post_type = get_post_type();

$content_view = get_theme_mod( $_post_type . '-view' );
$content_view = $content_view ? $content_view : $_post_type;

Controller::layout( 'blank' );
Controller::render( 'full', $content_view );
