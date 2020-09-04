<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.3.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'home-page-display-page-header',
	[
		'label'           => __( 'Display page header on homepage (You need to set the default page header or featured image)', 'snow-monkey' ),
		'default'         => false,
		'priority'        => 130,
		'active_callback' => function() {
			$page_on_front        = get_option( 'page_on_front' );
			$use_static_frontpage = 'page' === get_option( 'show_on_front' ) && ! empty( $page_on_front );

			$wp_page_template = get_post_meta( $page_on_front, '_wp_page_template', true );
			$is_blank         = false !== strpos( $wp_page_template, 'blank.php' );
			$is_blank_slim    = false !== strpos( $wp_page_template, 'blank-slim.php' );
			$is_blank_content = false !== strpos( $wp_page_template, 'blank-content.php' );

			$active = ! $is_blank && ! $is_blank_slim && ! $is_blank_content && $use_static_frontpage;

			return $active;
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'static_front_page' );
$control = Framework::get_control( 'home-page-display-page-header' );
$control->join( $section );
