<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'display-site-branding-in-drop-nav',
	array(
		'label'    => __( 'Display site logo in drop navigation.', 'snow-monkey' ),
		'priority' => 180,
		'default'  => false,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'display-site-branding-in-drop-nav' );
$control->join( $section )->join( $panel );
