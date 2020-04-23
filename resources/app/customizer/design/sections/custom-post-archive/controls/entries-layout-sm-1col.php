<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;
use Framework\Controller\Controller;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'checkbox',
		$custom_post_type . '-entries-layout-sm-1col',
		[
			'label'    => __( 'Make the entries one column on mobile device', 'snow-monkey' ),
			'priority' => 111,
			'default'  => false,
			'active_callback' => function() use ( $custom_post_type ) {
				$is_archive_view = 'archive' === Controller::get_view();
				$is_multi_cols_pattern = in_array( get_theme_mod( $custom_post_type . '-entries-layout' ), [ 'rich-media', 'panel' ] );
				return $is_archive_view && $is_multi_cols_pattern;
			},
			'sanitize_callback' => function( $value ) use ( $custom_post_type ) {
				$is_multi_cols_pattern = in_array( get_theme_mod( $custom_post_type . '-entries-layout' ), [ 'rich-media', 'panel' ] );
				return $is_multi_cols_pattern ? $value : false;
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
	$control = Framework::get_control( $custom_post_type . '-entries-layout-sm-1col' );
	$control->join( $section )->join( $panel );
}
