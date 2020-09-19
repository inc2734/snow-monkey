<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'post-entries-layout-sm-1col',
	[
		'label'             => __( 'Make the entries one column on mobile device', 'snow-monkey' ),
		'priority'          => 181,
		'default'           => false,
		'active_callback'   => function() {
			$is_multi_cols_pattern = in_array( get_theme_mod( 'post-entries-layout' ), [ 'rich-media', 'panel' ], true );
			return $is_multi_cols_pattern;
		},
		'sanitize_callback' => function( $value ) {
			$is_multi_cols_pattern = in_array( get_theme_mod( 'post-entries-layout' ), [ 'rich-media', 'panel' ], true );
			return $is_multi_cols_pattern ? $value : false;
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'post-entries-layout-sm-1col' );
$control->join( $section )->join( $panel );
