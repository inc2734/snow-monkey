<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

use Framework\Controller\Controller;

$_post_type_object = get_post_type_object( get_post_type() );

if ( $_post_type_object->hierarchical ) {
	$layout = get_theme_mod( 'page-layout' );
}

if ( empty( $layout ) ) {
	$layout = get_theme_mod( 'singular-post-layout' );
}

Controller::layout( $layout );
Controller::render( 'content', get_post_type() );
