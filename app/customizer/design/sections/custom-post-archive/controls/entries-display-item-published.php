<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.4.2
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'checkbox',
		$custom_post_type . '-entries-display-item-published',
		array(
			'label'             => __( 'Display the published date for each item in the entries', 'snow-monkey' ),
			'priority'          => 143,
			'default'           => false,
			'active_callback'   => function() use ( $custom_post_type ) {
				$archive_view = get_theme_mod( $custom_post_type . '-archive-view' );
				if ( 'post' === $archive_view ) {
					return false;
				}

				return true;
			},
			'sanitize_callback' => function( $value ) use ( $custom_post_type ) {
				$archive_view = get_theme_mod( $custom_post_type . '-archive-view' );
				if ( 'post' === $archive_view ) {
					return '';
				}

				return $value;
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
	$control = Framework::get_control( $custom_post_type . '-entries-display-item-published' );
	$control->join( $section )->join( $panel );
}
