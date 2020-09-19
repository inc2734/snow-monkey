<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.4.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;
use Framework\Controller\Controller;

$custom_post_types = Helper::get_custom_post_types();

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'select',
		$custom_post_type . '-entries-layout',
		[
			'label'           => __( 'Entries layout', 'snow-monkey' ),
			'priority'        => 110,
			'default'         => 'rich-media',
			'choices'         => [
				'rich-media' => __( 'Rich media', 'snow-monkey' ),
				'simple'     => __( 'Simple', 'snow-monkey' ),
				'text'       => __( 'Text', 'snow-monkey' ),
				'text2'      => __( 'Text 2', 'snow-monkey' ),
				'panel'      => __( 'Panels', 'snow-monkey' ),
			],
			'active_callback' => function() {
				return 'archive' === Controller::get_view();
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
	$control = Framework::get_control( $custom_post_type . '-entries-layout' );
	$control->join( $section )->join( $panel );
}
