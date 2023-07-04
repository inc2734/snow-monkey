<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.4.2
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'select',
	'related-posts-gap',
	array(
		'label'           => __( 'The gap between each item in the related posts', 'snow-monkey' ),
		'priority'        => 141,
		'default'         => '',
		'choices'         => array(
			''  => __( 'Default', 'snow-monkey' ),
			's' => __( 'S', 'snow-monkey' ),
			'm' => __( 'M', 'snow-monkey' ),
			'l' => __( 'L', 'snow-monkey' ),
		),
		'active_callback' => function() {
			return get_option( 'mwt-display-related-posts' ) ? true : false;
		},
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-post' );
$control = Framework::get_control( 'related-posts-gap' );
$control->join( $section )->join( $panel );
