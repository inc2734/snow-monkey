<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'mwt-twitter-card',
	array(
		'label'       => __( 'twitter:card', 'snow-monkey' ),
		'description' => __( 'Twitter Cards format', 'snow-monkey' ),
		'priority'    => 100,
		'default'     => 'summary',
		'type'        => 'option',
		'choices'     => array(
			''                    => __( 'Do not use', 'snow-monkey' ),
			'summary'             => 'Summary Card',
			'summary_large_image' => 'Summary Card with Large Image',
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo-sns' );
$section = Framework::get_section( 'twitter-cards' );
$control = Framework::get_control( 'mwt-twitter-card' );
$control->join( $section )->join( $panel );
