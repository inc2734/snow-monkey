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
	'base-design',
	[
		'title'    => __( 'Base design settings', 'snow-monkey' ),
		'priority' => 100,
	]
);
