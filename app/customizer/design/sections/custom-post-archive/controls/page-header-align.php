<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'select',
		'archive-' . $custom_post_type . '-page-header-align',
		[
			'label'           => __( 'Page header alignment', 'snow-monkey' ),
			'priority'        => 131,
			'default'         => 'center',
			'choices'         => Helper::page_header_align_choices(),
			'active_callback' => function() use ( $custom_post_type ) {
				return 'title-on-page-header' === get_theme_mod( 'archive-' . $custom_post_type . '-eyecatch' );
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
	$control = Framework::get_control( 'archive-' . $custom_post_type . '-page-header-align' );
	$control->join( $section )->join( $panel );
}
