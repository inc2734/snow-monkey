<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.10.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'jquery-loading-optimization',
	[
		'label'       => __( 'Optimize the jQuery loading', 'snow-monkey' ),
		'description' => __( 'Load jQuery and other scripts as defer + head as much as possible. Depending on your plugins and child theme, JavaScript error may occur.', 'snow-monkey' ),
		'priority'    => 105,
		'default'     => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'jquery-loading-optimization' );
$control->join( $section );
