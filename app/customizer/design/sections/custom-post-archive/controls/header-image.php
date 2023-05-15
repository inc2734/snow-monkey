<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

$custom_post_types = Helper::get_custom_post_types();

$panel = Framework::get_panel( 'design' );

foreach ( $custom_post_types as $custom_post_type ) {
	Framework::control(
		'image',
		$custom_post_type . '-header-image',
		array(
			'label'    => __( 'Featured Image', 'snow-monkey' ),
			'priority' => 130,
		)
	);

	$section = Framework::get_section( 'design-' . $custom_post_type . '-archive' );
	$control = Framework::get_control( $custom_post_type . '-header-image' );
	$control->join( $section )->join( $panel );
}
