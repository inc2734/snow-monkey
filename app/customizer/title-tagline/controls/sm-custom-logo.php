<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

$custom_logo_args = get_theme_support( 'custom-logo' );

Framework::control(
	'cropped-image',
	'sm-custom-logo',
	array(
		'label'       => __( 'Logo on mobile device', 'snow-monkey' ),
		'description' => __( 'If "Logo" is not set, "Logo on mobile device" is not used.', 'snow-monkey' ),
		'priority'    => 9,
		'height'      => isset( $custom_logo_args[0]['height'] ) ? $custom_logo_args[0]['height'] : null,
		'width'       => isset( $custom_logo_args[0]['width'] ) ? $custom_logo_args[0]['width'] : null,
		'flex_height' => isset( $custom_logo_args[0]['flex-height'] ) ? $custom_logo_args[0]['flex-height'] : null,
		'flex_width'  => isset( $custom_logo_args[0]['flex-width'] ) ? $custom_logo_args[0]['flex-width'] : null,
	)
);

$section = Framework::get_section( 'title_tagline' );
$control = Framework::get_control( 'sm-custom-logo' );
$control->join( $section );
