<?php
/**
 * Template Name: Landing page ( slim width )
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.6.0
 */

use Framework\Controller\Controller;

Controller::layout( 'blank-slim' );
Controller::render( 'content-full', get_post_type() );
