<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.0
 */

use Framework\Controller\Controller;

Controller::layout( get_theme_mod( 'archive-post-layout' ) );
if ( have_posts() ) {
	Controller::render( 'home' );
} else {
	Controller::render( 'home-none' );
}
