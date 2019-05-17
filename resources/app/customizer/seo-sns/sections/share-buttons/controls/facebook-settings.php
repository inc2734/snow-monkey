<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'share-buttons-facebook-settings',
	[
		'label'       => __( 'Facebook settings', 'snow-monkey' ),
		'description' => __( 'If you want to count of Facebook share count then needs to register Facebook App.', 'snow-monkey' ) . sprintf(
			__( '%1$sAccessToken tools%2$s', 'snow-monkey' ),
			'<a href="https://developers.facebook.com/tools/accesstoken" target="_blank">',
			'</a>'
		),
		'priority' => 90,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo-sns' );
$section = Framework::get_section( 'share-buttons' );
$control = Framework::get_control( 'share-buttons-facebook-settings' );
$control->join( $section )->join( $panel );
