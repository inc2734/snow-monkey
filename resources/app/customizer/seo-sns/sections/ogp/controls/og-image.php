<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'image',
	'mwt-default-og-image',
	array(
		'label'       => __( 'Default OGP image', 'snow-monkey' ),
		'description' => __( 'If a featured image is set in an article, that the featured image is used, if not set, this image will be used.', 'snow-monkey' ),
		'priority'    => 110,
		'type'        => 'option',
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'seo-sns' );
$section = $customizer->get_section( 'ogp' );
$control = $customizer->get_control( 'mwt-default-og-image' );
$control->join( $section )->join( $panel );
