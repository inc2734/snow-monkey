<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.3.4
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'number',
	'lg-logo-scale',
	[
		'label'           => __( 'Custom logo scale (%) on PC', 'snow-monkey' ),
		'priority'        => 131,
		'default'         => 50,
		'input_attrs'     => [
			'min' => 1,
			'max' => 100,
		],
		'active_callback' => function() {
			if ( ! Helper::use_auto_custom_logo_size() ) {
				return false;
			}

			$custom_logo = get_custom_logo();
			if ( ! $custom_logo ) {
				return false;
			}

			preg_match( '/height="(\d+(\.\d+)?)"/', $custom_logo, $reg );
			if ( ! isset( $reg[1] ) ) {
				return false;
			}

			return true;
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'lg-logo-scale' );
$control->join( $section )->join( $panel );
