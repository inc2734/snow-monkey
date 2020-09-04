<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'home-page-container',
	[
		'label'           => __( 'Add side padding to content area of homepage', 'snow-monkey' ),
		'default'         => true,
		'priority'        => 110,
		'active_callback' => function() {
			$page_on_front        = get_option( 'page_on_front' );
			$use_static_frontpage = 'page' === get_option( 'show_on_front' ) && ! empty( $page_on_front );

			$wp_page_template         = get_post_meta( $page_on_front, '_wp_page_template', true );
			$is_default_page_template = 'default' === $wp_page_template;
			$is_one_column_full       = false !== strpos( $wp_page_template, 'one-column-full.php' );

			$active = ( ! $wp_page_template || $is_default_page_template || $is_one_column_full ) && $use_static_frontpage;

			return $active;
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'static_front_page' );
$control = Framework::get_control( 'home-page-container' );
$control->join( $section );
