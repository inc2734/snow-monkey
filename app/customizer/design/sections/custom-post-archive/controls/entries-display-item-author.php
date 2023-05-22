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
		$custom_post_type . '-entries-layout-display-item-author',
		array(
			'label'             => __( 'Display the author for each item in the entries', 'snow-monkey' ),
			'priority'          => 141,
			'default'           => false,
			'active_callback'   => function() use ( $custom_post_type ) {
				$is_display_item_author = 'text' !== get_theme_mod( $custom_post_type . '-entries-layout' );
				return $is_display_item_author;
			},
		)
	);
}

if ( ! is_customize_preview() ) {
	return;
}

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	$section = Framework::get_section( 'design-' . $custom_post_type . '-archive' );
	$control = Framework::get_control( $custom_post_type . '-entries-layout-display-item-author' );
	$control->join( $section )->join( $panel );
}
