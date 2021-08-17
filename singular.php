<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.4
 */

use Framework\Helper;
use Framework\Controller\Controller;

$_post_type = get_post_type();

$layout = get_theme_mod( $_post_type . '-layout' );
$layout = $layout ? $layout : get_theme_mod( 'post-layout' );

$is_blank = false !== strpos( $layout, 'blank' );
$slug     = $is_blank ? 'full' : 'content';

$content_view = get_theme_mod( $_post_type . '-view' );
$slug         = in_array( $content_view, [ 'post', 'page' ], true ) ? 'content' : $slug;
$content_view = $content_view ? $content_view : $_post_type;

Controller::layout( $layout );
Controller::render( $slug, $content_view );
