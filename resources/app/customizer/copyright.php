<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$theme_link = sprintf(
	'<a href="https://2inc.org" target="_blank">%s</a>',
	__( 'Monkey Wrench', 'snow-monkey' )
);

$wordpress_link = sprintf(
	'<a href="https://wordpress.org/" target="_blank">%s</a>',
	__( 'WordPress', 'snow-monkey' )
);

$theme_by   = sprintf( __( 'Snow Monkey theme by %s', 'snow-monkey' ), $theme_link );
$powered_by = sprintf( __( 'Powered by %s', 'snow-monkey' ), $wordpress_link );
$copyright  = $theme_by . ' ' . $powered_by;

$customizer = Customizer_Framework::init();

$customizer->section( 'copyright', [
	'title' => __( 'Copyright', 'snow-monkey' ),
] );

$customizer->control( 'text', 'inc2734-theme-option-copyright', [
	'label'       => __( 'Copyright', 'snow-monkey' ),
	'description' => __( 'HTML usable', 'snow-monkey' ),
	'default'     => $copyright,
] );

$section = $customizer->get_section( 'copyright' );
$control = $customizer->get_control( 'inc2734-theme-option-copyright' );
$control->join( $section );
