<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Controller\Controller;

$_post_type_object = get_post_type_object( get_post_type() );

if ( ! empty( $_post_type_object->hierarchical ) ) {
	$layout = get_theme_mod( 'page-layout' );
}

if ( empty( $layout ) ) {
	$layout = get_theme_mod( 'singular-post-layout' );
}

$_post_type   = get_post_type();
$content_view = get_theme_mod( $_post_type . '-view' );
$content_view = $content_view ? $content_view : $_post_type;

Controller::layout( $layout );
Controller::render( 'content', $content_view );
