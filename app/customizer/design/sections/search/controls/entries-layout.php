<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

$custom_post_types = Helper::get_search_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'select',
		'search-' . $custom_post_type . '-entries-layout',
		array(
			'label'    => __( 'Entries layout', 'snow-monkey' ),
			'priority' => 150,
			'default'  => '',
			'choices'  => array(
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
		)
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type . '-search' );
	$control = Framework::get_control( 'search-' . $custom_post_type . '-entries-layout' );
	$control->join( $section )->join( $panel );
}
