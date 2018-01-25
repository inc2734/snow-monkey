<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$controller = new Mimizuku_Controller();
$controller->layout( get_theme_mod( 'archive-page-layout' ) );
if ( have_posts() ) {
	$controller->render( 'archive', 'search' );
} else {
	$controller->render( 'no-match' );
}
