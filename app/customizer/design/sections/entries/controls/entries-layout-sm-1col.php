<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 *
 * renamed: app/customizer/design/sections/base-design/controls/entries-layout-sm-1col.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'post-entries-layout-sm-1col',
	array(
		'default'           => false,
		'sanitize_callback' => function ( $value ) {
			$is_multi_cols_pattern = in_array( get_theme_mod( 'post-entries-layout' ), array( 'rich-media', 'panel' ), true );
			return $is_multi_cols_pattern && $value ? $value : '';
		},
		'ui_args_callback'  => function () {
			return array(
				'label'           => __( 'Make the entries one column on mobile device', 'snow-monkey' ),
				'priority'        => 170,
				'active_callback' => function () {
					$is_multi_cols_pattern = in_array( get_theme_mod( 'post-entries-layout' ), array( 'rich-media', 'panel' ), true );
					return $is_multi_cols_pattern;
				},
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'entries' );
$control = Framework::get_control( 'post-entries-layout-sm-1col' );
$control->join( $section )->join( $panel );
