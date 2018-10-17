<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'select',
	'base-font',
	[
		'label'    => __( 'Base font', 'snow-monkey' ),
		'priority' => 120,
		'default'  => 'sans-serif',
		'choices'  => [
			'sans-serif'    => __( 'Sans serif', 'snow-monkey' ),
			'serif'         => __( 'Serif', 'snow-monkey' ),
			'noto-sans-jp'  => __( 'Noto Sans JP', 'snow-monkey' ),
			'noto-serif-jp' => __( 'Noto Serif JP', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'base-design' );
$control = $customizer->get_control( 'base-font' );
$control->join( $section )->join( $panel );
