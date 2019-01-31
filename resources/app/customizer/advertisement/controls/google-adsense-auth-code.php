<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'textarea',
	'mwt-google-adsense-auth-code',
	[
		'label'             => __( 'Google Adsense authentication code', 'snow-monkey' ),
		'description'       => __( 'Paste only the contents of script tag.', 'snow-monkey' ),
		'type'              => 'option',
		'priority'          => 100,
		'sanitize_callback' => function( $value ) {
			return strip_tags( $value );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'advertisement' );
$control = Framework::get_control( 'mwt-google-adsense-auth-code' );
$control->join( $section );
