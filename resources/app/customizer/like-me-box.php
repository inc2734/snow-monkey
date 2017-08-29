<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'like-me-box', [
	'title' => __( 'Like me box', 'snow-monkey' ),
] );

$customizer->control( 'text', 'inc2734-theme-option-facebook-page-name', [
	'label'       => __( 'Facebook page name', 'snow-monkey' ),
	'description' => sprintf(
		_x( 'Please enter %1$s of %2$s', 'facebook-page-name', 'snow-monkey' ),
		'<code>xxxxx</code>',
		'<code>https://www.facebook.com/xxxxx</code>'
	),
	'type' => 'option',
] );

$section = $customizer->get_section( 'like-me-box' );
$control = $customizer->get_control( 'inc2734-theme-option-facebook-page-name' );
$control->join( $section );
