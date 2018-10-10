<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'text',
	'mwt-fb-app-id',
	[
		'label'       => __( 'fb:app_id', 'snow-monkey' ),
		'description' => __( 'If you want to output fb:app_id meta tag, please input.', 'snow-monkey' )
										. sprintf(
											__( 'fb:app_id can be obtained from %1$sfacebook for developers%2$s.', 'snow-monkey' ),
											'<a href="https://developers.facebook.com/" target="_blank">',
											'</a>'
										),
		'priority'    => 120,
		'type'        => 'option',
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'seo-sns' );
$section = $customizer->get_section( 'ogp' );
$control = $customizer->get_control( 'mwt-fb-app-id' );
$control->join( $section )->join( $panel );
