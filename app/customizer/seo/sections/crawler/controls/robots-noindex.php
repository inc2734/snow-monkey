<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/crawler/controls/robots-noindex.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'multiple-checkbox',
	'mwt-robots-noindex',
	[
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
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'crawler' );
$control = Framework::get_control( 'mwt-robots-noindex' );
$control->join( $section )->join( $panel );
