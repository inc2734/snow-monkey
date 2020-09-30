<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 *
 * renamed: app/customizer/seo-sns/sections/share-buttons/controls/facebook-app-token.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'facebook-app-token',
	[
		'label'       => __( 'Facebook settings', 'snow-monkey' ),
		'description' => __( 'If you want to count of Facebook share count then needs to register Facebook App.', 'snow-monkey' ) . sprintf(
			/* translators: 1: <a> tag, 2: </a> tag */
			__( '%1$sAccessToken tools%2$s', 'snow-monkey' ),
			'<a href="https://developers.facebook.com/tools/accesstoken" target="_blank" rel="noreferrer">',
			'</a>'
		),
		'priority'    => 90,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'sns' );
$section = Framework::get_section( 'share-buttons' );
$control = Framework::get_control( 'facebook-app-token' );
$control->join( $section )->join( $panel );
