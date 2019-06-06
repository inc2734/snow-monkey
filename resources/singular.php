<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 */

use Framework\Controller\Controller;

Controller::layout( get_theme_mod( 'singular-post-layout' ) );
Controller::render( 'content', get_post_type() );
