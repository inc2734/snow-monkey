<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$controller = new Mimizuku_Controller();
$controller->layout( get_theme_mod( 'woocommerce-archive-page-layout' ) );
$controller->render( 'woocommerce-archive-product' );
