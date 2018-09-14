<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$_post_type = get_post_type();

$controller = new Mimizuku_Controller();
$controller->layout( get_theme_mod( 'singular-post-layout' ) );
$controller->render( 'content', $_post_type );
