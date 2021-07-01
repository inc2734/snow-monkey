<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'mwt-google-auto-ads',
	[
		'label'             => __( 'Google Adsense Auto Ads', 'snow-monkey' ),
		'description'       => __( 'Paste only the value of data-ad-client of script tag.', 'snow-monkey' ) . __( 'Authentication can also be performed by setting this option.', 'snow-monkey' ),
		'type'              => 'option',
		'priority'          => 105,
		'sanitize_callback' => function( $value ) {
			return strip_tags( $value );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'advertisement' );
$control = Framework::get_control( 'mwt-google-auto-ads' );
$control->join( $section );
