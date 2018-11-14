<?php
/**
 * Template Name: Landing page ( has side margins )
 * Template Post Type: post, page
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\App\Controller\Controller;

Controller::layout( 'blank-fluid' );
Controller::render( 'content-full', get_post_type() );
