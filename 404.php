<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.0
 */

use Framework\Controller\Controller;

global $wp_query;

$_post_type = $wp_query->get( 'post_type' );

$layout = $_post_type ? get_theme_mod( $_post_type . '-layout' ) : get_theme_mod( 'page-layout' );
$layout = $layout ? $layout : get_theme_mod( 'post-layout' );

Controller::layout( $layout );
Controller::render( '404' );
