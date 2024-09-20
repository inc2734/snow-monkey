<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.2.0
 *
 * renamed: app/customizer/design/sections/base-design/controls/entries-display-item-excerpt.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

$entries_layout = get_theme_mod( 'post-entries-layout' );
$default        = in_array(
	$entries_layout ? $entries_layout : 'rich-media',
	array( 'rich-media', 'simple', 'carousel' ),
	true
);

Framework::control(
	'checkbox',
	'post-entries-display-item-excerpt',
	array(
		'label'             => __( 'Display the excerpt for each item in the entries', 'snow-monkey' ),
		'priority'          => 160,
		'default'           => $default,
		'active_callback'   => function () {
			$is_display_item_excerpt = in_array(
				get_theme_mod( 'post-entries-layout' ),
				array( 'rich-media', 'simple', 'panel', 'carousel' ),
				true
			);

			return $is_display_item_excerpt;
		},
		'sanitize_callback' => function ( $value ) {
			$is_display_item_excerpt = in_array(
				get_theme_mod( 'post-entries-layout' ),
				array( 'rich-media', 'simple', 'panel', 'carousel' ),
				true
			);

			return $is_display_item_excerpt && $value ? $value : '';
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'entries' );
$control = Framework::get_control( 'post-entries-display-item-excerpt' );
$control->join( $section )->join( $panel );
