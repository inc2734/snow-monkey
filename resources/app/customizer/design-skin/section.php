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
	'design-skin',
	[
		'title'       => __( 'Design skin', 'snow-monkey' ),
		'priority'    => 1030,
		'description' => sprintf(
			__( 'Design skins can be downloaded from the %1$sdesign skin page%2$s.', 'snow-monkey' ),
			'<a href="https://snow-monkey.2inc.org/design-skin/" target="_blank">',
			'</a>'
		),
	]
);
