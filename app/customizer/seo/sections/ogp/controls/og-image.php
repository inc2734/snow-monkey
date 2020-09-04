<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/ogp/controls/og-image.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
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

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'ogp' );
$control = Framework::get_control( 'mwt-default-og-image' );
$control->join( $section )->join( $panel );
