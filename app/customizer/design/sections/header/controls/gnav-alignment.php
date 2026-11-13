<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'gnav-alignment',
	array(
		'default'          => 'right',
		'ui_args_callback' => function () {
			return array(
				'label'           => __( 'Global navigation alignment', 'snow-monkey' ),
				'priority'        => 101,
				'choices'         => array(
					'right'  => __( 'Right', 'snow-monkey' ),
					'center' => __( 'Center', 'snow-monkey' ),
					'left'   => __( 'Left', 'snow-monkey' ),
				),
				'active_callback' => function () {
					return '1row' === get_theme_mod( 'header-layout' );
				},
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'gnav-alignment' );
$control->join( $section )->join( $panel );
