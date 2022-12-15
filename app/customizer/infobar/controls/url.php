<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'infobar-url',
	array(
		'label'    => __( 'Infobar link URL', 'snow-monkey' ),
		'priority' => 110,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-url' );
$control->join( $section );
