<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control( 'multiple-checkbox', 'mwt-robots-noindex', [
	'type'     => 'option',
	'label'    => __( 'noindex settings', 'snow-monkey' ),
	'priority' => 100,
	'default'  => '',
	'choices'  => [
		'category' => __( 'Set category pages to noindex', 'snow-monkey' ),
		'post_tag' => __( 'Set tag pages to noindex', 'snow-monkey' ),
		'author'   => __( 'Set author pages to noindex', 'snow-monkey' ),
		'year'     => __( 'Set year pages to noindex', 'snow-monkey' ),
		'month'    => __( 'Set month pages to noindex', 'snow-monkey' ),
		'day'      => __( 'Set day pages to noindex', 'snow-monkey' ),
	],
] );

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'seo-sns' );
$section = $customizer->get_section( 'crawler' );
$control = $customizer->get_control( 'mwt-robots-noindex' );
$control->join( $section )->join( $panel );
