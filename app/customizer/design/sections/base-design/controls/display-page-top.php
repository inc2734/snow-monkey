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
	'display-page-top',
	array(
		'default'          => true,
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Display the page top button', 'snow-monkey' ),
				'priority' => 260,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'display-page-top' );
$control->join( $section )->join( $panel );
