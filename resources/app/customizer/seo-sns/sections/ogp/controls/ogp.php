<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'mwt-ogp',
	array(
		'label'    => __( 'Output OGP meta tag', 'snow-monkey' ),
		'type'     => 'option',
		'priority' => 100,
		'default'  => true,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo-sns' );
$section = Framework::get_section( 'ogp' );
$control = Framework::get_control( 'mwt-ogp' );
$control->join( $section )->join( $panel );
