<?php
/**
 * Template Name: Landing page ( with header/footer )
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Controller\Controller;

Controller::layout( 'blank-content' );
Controller::render( 'full', get_post_type() );
