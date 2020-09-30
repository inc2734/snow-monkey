<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 *
 * renamed: app/customizer/seo-sns/sections/ogp/controls/fb-app-id.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'mwt-fb-app-id',
	[
		'label'       => __( 'fb:app_id', 'snow-monkey' ),
		'description' => __( 'If you want to output fb:app_id meta tag, please input.', 'snow-monkey' ) . sprintf(
			/* translators: 1: <a> tag, 2: </a> tag */
			__( 'fb:app_id can be obtained from %1$sfacebook for developers%2$s.', 'snow-monkey' ),
			'<a href="https://developers.facebook.com/" target="_blank" rel="noreferrer">',
			'</a>'
		),
		'priority'    => 120,
		'type'        => 'option',
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'ogp' );
$control = Framework::get_control( 'mwt-fb-app-id' );
$control->join( $section )->join( $panel );
