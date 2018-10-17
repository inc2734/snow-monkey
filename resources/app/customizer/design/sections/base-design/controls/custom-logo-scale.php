<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'number',
	'sm-logo-scale',
	[
		'label'       => __( 'Custom logo scale (%) on smartphone', 'snow-monkey' ),
		'priority'    => 170,
		'default'     => 25,
		'input_attrs' => [
			'min' => 25,
			'max' => 50,
		],
		'active_callback' => function() {
			$custom_logo = get_custom_logo();
			if ( ! $custom_logo ) {
				return false;
			}

			preg_match( '/height="(\d+?)"/', $custom_logo, $reg );
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

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'base-design' );
$control = $customizer->get_control( 'sm-logo-scale' );
$control->join( $section )->join( $panel );
