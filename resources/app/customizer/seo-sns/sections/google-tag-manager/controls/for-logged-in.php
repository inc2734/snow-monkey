<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'checkbox',
	'mwt-google-tag-manager-for-loggedin',
	array(
		'label'    => __( 'Don\'t output tags to logged-in users', 'snow-monkey' ),
		'default'  => true,
		'type'     => 'option',
		'priority' => 110,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'seo-sns' );
$section = $customizer->get_section( 'google-tag-manager' );
$control = $customizer->get_control( 'mwt-google-tag-manager-for-loggedin' );
$control->join( $section )->join( $panel );
