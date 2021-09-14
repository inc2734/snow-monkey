<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.8.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'expand-get-template-part',
	[
		'label'       => __( 'Extends get_template_part()', 'snow-monkey' ),
		'description' => __( 'When disabled, customization by code may not be reflected. For details, please refer to the manual on the official website.', 'snow-monkey' ),
		'default'     => true,
		'priority'    => 240,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'page-speed-optimization' );
$control = Framework::get_control( 'expand-get-template-part' );
$control->join( $section );
