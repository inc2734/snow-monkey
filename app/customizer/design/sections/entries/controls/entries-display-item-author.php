<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 *
 * renamed: app/customizer/design/sections/base-design/controls/entries-display-item-author.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

$entries_layout = get_theme_mod( 'post-entries-layout' );
$default        = ! in_array(
	$entries_layout ? $entries_layout : 'rich-media',
	array( 'text', 'text2' ),
	true
);

Framework::control(
	'checkbox',
	'post-entries-display-item-author',
	array(
		'default'           => $default,
		'sanitize_callback' => function ( $value ) {
			$is_display_item_author = ! in_array(
				get_theme_mod( 'post-entries-layout' ),
				array( 'text' ),
				true
			);

			return $is_display_item_author && $value ? $value : '';
		},
		'ui_args_callback'  => function () {
			return array(
				'label'           => __( 'Display the author for each item in the entries', 'snow-monkey' ),
				'priority'        => 120,
				'active_callback' => function () {
					$is_display_item_author = ! in_array(
						get_theme_mod( 'post-entries-layout' ),
						array( 'text' ),
						true
					);

					return $is_display_item_author;
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
$control = Framework::get_control( 'post-entries-display-item-author' );
$control->join( $section )->join( $panel );
