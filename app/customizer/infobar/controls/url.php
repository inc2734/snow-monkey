<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'text',
	'infobar-url',
	array(
		'label'    => __( 'Infobar link URL', 'snow-monkey' ),
		'priority' => 110,
	)
);

$section = Framework::get_section( 'infobar' );
$control = Framework::get_control( 'infobar-url' );
$control->join( $section );
