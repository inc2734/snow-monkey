<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'text',
	'infobar-url',
	[
		'label' => __( 'Infobar link URL', 'snow-monkey' ),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = $customizer->get_section( 'infobar' );
$control = $customizer->get_control( 'infobar-url' );
$control->join( $section );
