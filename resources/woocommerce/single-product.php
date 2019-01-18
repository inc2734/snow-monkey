<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Controller\Controller;

Controller::layout( get_theme_mod( 'woocommerce-single-layout' ) );
Controller::render( 'woocommerce-content-product' );
