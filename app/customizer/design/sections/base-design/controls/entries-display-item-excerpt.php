<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'post-entries-layout-display-item-excerpt',
	array(
		'label'    => __( 'Display the excerpt for each item in the entries', 'snow-monkey' ),
		'priority' => 183,
		'default'  => in_array( get_theme_mod( 'post-entries-layout' ), array( 'rich-media', 'simple', 'carousel' ), true ),
		'active_callback' => function() {
			$is_display_item_excerpt = in_array( get_theme_mod( 'post-entries-layout' ), array( 'rich-media', 'simple', 'panel', 'carousel' ), true );
			return $is_display_item_excerpt;
		},
		'sanitize_callback' => function( $value ) {
			$is_display_item_excerpt = in_array( get_theme_mod( 'post-entries-layout' ), array( 'rich-media', 'simple', 'panel', 'carousel' ), true );
			return $is_display_item_excerpt ? $value : false;
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'post-entries-layout-display-item-excerpt' );
$control->join( $section )->join( $panel );
