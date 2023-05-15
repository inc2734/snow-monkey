<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 *
 * renamed: app/customizer/seo-sns/sections/google-search-console/controls/google-site-verification.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'text',
	'mwt-google-site-verification',
	array(
		'type'        => 'option',
		'label'       => __( 'Google site verification', 'snow-monkey' ),
		'description' => sprintf(
			/* translators: 1: content of google-site-verification, 2: google-site-verification meta tag */
			__( 'Please enter part %1$s of %2$s', 'snow-monkey' ),
			'<code>xxxx</code>',
			'<code>&lt;meta name="google-site-verification" content="xxxxx" /&gt;</code>'
		),
	)
);

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'google-search-console' );
$control = Framework::get_control( 'mwt-google-site-verification' );
$control->join( $section )->join( $panel );
