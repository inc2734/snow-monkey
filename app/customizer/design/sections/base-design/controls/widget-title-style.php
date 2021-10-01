<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.9.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;


Framework::control(
	'select',
	'widget-title-style',
	[
		'label'           => __( 'Design of widget-titles', 'snow-monkey' ),
		'priority'        => 280,
		'default'         => 'standard',
		'choices'         => [
			''         => __( 'None', 'snow-monkey' ),
			'standard' => __( 'Standard', 'snow-monkey' ),
		],
		'active_callback' => function() {
			$handle = Helper::get_main_style_handle() . '-theme';
			return wp_style_is( $handle ) && wp_styles()->registered[ $handle ]->src;
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'widget-title-style' );
$control->join( $section )->join( $panel );
