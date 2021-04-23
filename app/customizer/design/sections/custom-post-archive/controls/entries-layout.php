<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'select',
		$custom_post_type . '-entries-layout',
		[
			'label'    => __( 'Entries layout', 'snow-monkey' ),
			'priority' => 140,
			'default'  => 'rich-media',
			'choices'  => [
				'rich-media' => __( 'Rich media', 'snow-monkey' ),
				'simple'     => __( 'Simple', 'snow-monkey' ),
				'text'       => __( 'Text', 'snow-monkey' ),
				'text2'      => __( 'Text 2', 'snow-monkey' ),
				'panel'      => __( 'Panels', 'snow-monkey' ),
				'carousel'   => sprintf(
					// translators: %1$s: entries layout
					__( 'Carousel (%1$s)', 'snow-monkey' ),
					__( 'Rich media', 'snow-monkey' )
				),
			],
		]
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type . '-archive' );
	$control = Framework::get_control( $custom_post_type . '-entries-layout' );
	$control->join( $section )->join( $panel );
}
