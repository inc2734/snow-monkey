<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.2.3
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'checkbox',
		$custom_post_type . '-entries-display-item-author',
		array(
			'label'             => __( 'Display the author for each item in the entries', 'snow-monkey' ),
			'priority'          => 142,
			'default'           => false,
			'active_callback'   => function() use ( $custom_post_type ) {
				$archive_view = get_theme_mod( $custom_post_type . '-archive-view' );
				if ( 'post' === $archive_view ) {
					return false;
				}

				$is_display_item_author = ! in_array(
					get_theme_mod( $custom_post_type . '-entries-layout' ),
					array( 'text', 'text2' ),
					true
				);

				return $is_display_item_author;
			},
			'sanitize_callback' => function( $value ) use ( $custom_post_type ) {
				$is_display_item_author = ! in_array(
					get_theme_mod( $custom_post_type . '-entries-layout' ),
					array( 'text', 'text2' ),
					true
				);

				$archive_view = get_theme_mod( $custom_post_type . '-archive-view' );
				if ( 'post' === $archive_view ) {
					return $is_display_item_author;
				}

				return $is_display_item_author && $value ? $value : '';
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
	$control = Framework::get_control( $custom_post_type . '-entries-display-item-author' );
	$control->join( $section )->join( $panel );
}
