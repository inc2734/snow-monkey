<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'select',
	'related-posts-layout',
	array(
		'label'           => __( 'Related posts layout', 'snow-monkey' ),
		'priority'        => 140,
		'default'         => '',
		'choices'         => array(
			''            => __( 'Default', 'snow-monkey' ),
			'rich-media'  => __( 'Rich media', 'snow-monkey' ),
			'simple'      => __( 'Simple', 'snow-monkey' ),
			'text'        => __( 'Text', 'snow-monkey' ),
			'text2'       => __( 'Text 2', 'snow-monkey' ),
			'panel'       => __( 'Panels', 'snow-monkey' ),
			'carousel'    => sprintf(
				// translators: %1$s: entries layout.
				__( 'Carousel (%1$s)', 'snow-monkey' ),
				__( 'Rich media', 'snow-monkey' )
			),
			'large-image' => __( 'Large image', 'snow-monkey' ),
		),
		'active_callback' => function () {
			return get_option( 'mwt-display-related-posts' ) ? true : false;
		},
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-post' );
$control = Framework::get_control( 'related-posts-layout' );
$control->join( $section )->join( $panel );
