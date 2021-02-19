<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.0
 */

use Framework\Controller\Controller;

$_post_type = get_post_type();

$layout = get_theme_mod( $_post_type . '-layout' );
$layout = $layout ? $layout : get_theme_mod( 'post-layout' );

$content_view = get_theme_mod( $_post_type . '-view' );
$content_view = $content_view ? $content_view : $_post_type;

Controller::layout( $layout );
Controller::render( 'content', $content_view );
