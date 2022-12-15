<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'color',
	'infobar-background-color',
	array(
		'label'    => __( 'Background color', 'snow-monkey' ),
		'default'  => get_theme_mod( 'accent-color' ),
		'priority' => 130,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-background-color' );
$control->join( $section );
