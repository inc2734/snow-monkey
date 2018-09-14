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
	'mwt-google-site-verification',
	array(
		'type'        => 'option',
		'label'       => __( 'Google site verification', 'snow-monkey' ),
		'description' => sprintf(
			__( 'Please enter part %1$s of %2$s', 'snow-monkey' ),
			'<code>xxxx</code>',
			'<code>&lt;meta name="google-site-verification" content="xxxxx" /&gt;</code>'
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'seo-sns' );
$section = $customizer->get_section( 'google-search-console' );
$control = $customizer->get_control( 'mwt-google-site-verification' );
$control->join( $section )->join( $panel );
