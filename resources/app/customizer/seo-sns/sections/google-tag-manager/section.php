<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

if ( ! is_customize_preview() ) {
	return;
}

$customizer = Customizer_Framework::init();

$customizer->section(
	'google-tag-manager',
	array(
		'title'    => __( 'Google Tag Manager', 'snow-monkey' ),
		'priority' => 120,
	)
);
