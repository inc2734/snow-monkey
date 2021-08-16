<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.1
 */

use Framework\Helper;
use Framework\Controller\Controller;

$_post_type = get_post_type();

$layout = get_theme_mod( $_post_type . '-layout' );
$layout = $layout ? $layout : get_theme_mod( 'post-layout' );

if ( Helper::locate_template( 'page-templates/' . $layout . '.php' ) ) {
	Helper::get_template_part( 'page-templates/' . $layout );
} else {
	$content_view = get_theme_mod( $_post_type . '-view' );
	$content_view = $content_view ? $content_view : $_post_type;

	Controller::layout( $layout );
	Controller::render( 'content', $content_view );
}
