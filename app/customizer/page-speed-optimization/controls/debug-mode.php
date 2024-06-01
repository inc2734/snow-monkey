<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'debug-mode',
	array(
		'label'           => __( 'Enable Snow Monkey debug mode', 'snow-monkey' ),
		'description'     => __( 'For details, please refer to the manual on the official website.', 'snow-monkey' ),
		'default'         => true,
		'priority'        => 245,
		'active_callback' => function () {
			return get_theme_mod( 'expand-get-template-part' ) && defined( 'WP_DEBUG' ) && WP_DEBUG;
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'debug-mode' );
$control->join( $section );
