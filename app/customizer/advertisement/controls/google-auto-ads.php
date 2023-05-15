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

Framework::control(
	'text',
	'mwt-google-auto-ads',
	array(
		'label'             => __( 'Google Adsense Auto Ads', 'snow-monkey' ),
		'description'       => __( 'Paste only the value of data-ad-client of script tag.', 'snow-monkey' ) . __( 'Authentication can also be performed by setting this option.', 'snow-monkey' ),
		'type'              => 'option',
		'priority'          => 105,
		'sanitize_callback' => function( $value ) {
			return strip_tags( $value );
		},
	)
);

$section = Framework::get_section( 'advertisement' );
$control = Framework::get_control( 'mwt-google-auto-ads' );
$control->join( $section );
