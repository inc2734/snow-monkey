<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'infobar-link-target',
	array(
		'label'           => __( 'Infobar link target', 'snow-monkey' ),
		'default'         => '_self',
		'priority'        => 111,
		'choices'         => array(
			'_self'   => esc_html__( 'Open in the same window', 'snow-monkey' ),
			'_target' => esc_html__( 'Open in new window', 'snow-monkey' ),
		),
		'active_callback' => function () {
			return ! empty( get_theme_mod( 'infobar-url' ) );
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-link-target' );
$control->join( $section );
