<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'image',
		$custom_post_type . '-header-image',
		[
			'label'           => __( 'Featured Image', 'snow-monkey' ),
			'priority'        => 130,
			'active_callback' => function() use ( $custom_post_type ) {
				return 'none' !== get_theme_mod( 'archive-' . $custom_post_type . '-eyecatch' );
			},
		]
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type . '-archive' );
	$control = Framework::get_control( $custom_post_type . '-header-image' );
	$control->join( $section )->join( $panel );
}
