<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.1
 *
 * renamed: app/customizer/design/sections/base-design/controls/entries-display-item-author.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'post-entries-layout-display-item-author',
	array(
		'label'             => __( 'Display the author for each item in the entries', 'snow-monkey' ),
		'priority'          => 120,
		'default'           => 'text' !== get_theme_mod( 'post-entries-layout' ),
		'active_callback'   => function() {
			$is_display_item_author = 'text' !== get_theme_mod( 'post-entries-layout' );
			return $is_display_item_author;
		},
		'sanitize_callback' => function( $value ) {
			$is_display_item_author = 'text' !== get_theme_mod( 'post-entries-layout' );
			return $is_display_item_author ? $value : false;
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'entries' );
$control = Framework::get_control( 'post-entries-layout-display-item-author' );
$control->join( $section )->join( $panel );
