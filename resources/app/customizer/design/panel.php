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

$customizer->panel( 'design', [
	'title'    => __( 'Design', 'snow-monkey' ),
	'priority' => 1000,
] );
