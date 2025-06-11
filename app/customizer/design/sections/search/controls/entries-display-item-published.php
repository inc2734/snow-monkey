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
		'search-' . $custom_post_type . '-entries-display-item-published',
		array(
			'label'    => __( 'Display the published date for each item in the entries', 'snow-monkey' ),
			'priority' => 190,
			'default'  => '',
			'choices'  => array(
				''      => __( 'Default', 'snow-monkey' ),
				'true'  => __( 'Force display (if supported)', 'snow-monkey' ),
				'false' => __( 'Force to hide', 'snow-monkey' ),
			),
		)
	);
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type . '-search' );
	$control = Framework::get_control( 'search-' . $custom_post_type . '-entries-display-item-published' );
	$control->join( $section )->join( $panel );
}
