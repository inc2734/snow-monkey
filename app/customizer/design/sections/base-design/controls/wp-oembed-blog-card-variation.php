<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.2.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'select',
	'wp-oembed-blog-card-variation',
	array(
		'label'           => __( 'The blog card design', 'snow-monkey' ),
		'priority'        => 290,
		'default'         => '',
		'choices'         => array(
			''               => __( 'Default', 'snow-monkey' ),
			'bgcolor-accent' => __( 'Background color (Accent color)', 'snow-monkey' ),
			'border-accent'  => __( 'Border (Accent color)', 'snow-monkey' ),
			'simple'         => __( 'Simple', 'snow-monkey' ),
			'dark'           => __( 'Dark', 'snow-monkey' ),
			'media'          => __( 'Media', 'snow-monkey' ),
		),
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'wp-oembed-blog-card-variation' );
$control->join( $section )->join( $panel );
