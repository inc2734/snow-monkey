<?php
/**
 * Template Name: Landing page
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
 */

use Framework\Controller\Controller;

Controller::layout( 'blank' );
Controller::render( 'full', get_post_type() );
