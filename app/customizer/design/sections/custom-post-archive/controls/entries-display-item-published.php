<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'checkbox',
		$custom_post_type . '-entries-layout-display-item-published',
		array(
			'label'    => __( 'Display the published date for each item in the entries', 'snow-monkey' ),
			'priority' => 142,
			'default'  => false,
		)
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type . '-archive' );
	$control = Framework::get_control( $custom_post_type . '-entries-layout-display-item-published' );
	$control->join( $section )->join( $panel );
}
