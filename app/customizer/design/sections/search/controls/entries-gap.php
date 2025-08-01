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
		'search-' . $custom_post_type . '-entries-gap',
		array(
			'label'    => __( 'The gap between each item in the entries', 'snow-monkey' ),
			'priority' => 160,
			'default'  => '',
			'choices'  => array(
				''  => __( 'Default', 'snow-monkey' ),
				's' => __( 'S', 'snow-monkey' ),
				'm' => __( 'M', 'snow-monkey' ),
				'l' => __( 'L', 'snow-monkey' ),
			),
		)
	);
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type . '-search' );
	$control = Framework::get_control( 'search-' . $custom_post_type . '-entries-gap' );
	$control->join( $section )->join( $panel );
}
