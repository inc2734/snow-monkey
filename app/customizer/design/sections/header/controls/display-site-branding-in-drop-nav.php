<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'display-site-branding-in-drop-nav',
	array(
		'default'          => false,
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Display site logo in drop navigation.', 'snow-monkey' ),
				'priority' => 180,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'display-site-branding-in-drop-nav' );
$control->join( $section )->join( $panel );
