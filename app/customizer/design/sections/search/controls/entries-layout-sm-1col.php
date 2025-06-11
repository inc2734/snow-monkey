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
		'search-' . $custom_post_type . '-entries-layout-sm-1col',
		array(
			'label'    => __( 'Make the entries one column on mobile device', 'snow-monkey' ),
			'priority' => 170,
			'default'  => '',
			'choices'  => array(
				''      => __( 'Default', 'snow-monkey' ),
				'true'  => __( 'Force one column', 'snow-monkey' ),
				'false' => __( 'Don\'t force one column', 'snow-monkey' ),
			),
		)
	);
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type . '-search' );
	$control = Framework::get_control( 'search-' . $custom_post_type . '-entries-layout-sm-1col' );
	$control->join( $section )->join( $panel );
}
