<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$post_type = get_post_type();

$controller = new Mimizuku_Controller();
$controller->layout( 'one-column-slim' );
$controller->render( 'woocommerce-content-product' );
