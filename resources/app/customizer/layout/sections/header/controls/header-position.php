<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'header-position',
	[
		'label'    => __( 'Header position', 'snow-monkey' ),
		'priority' => 110,
		'default'  => 'sticky',
		'choices'  => [
			'sticky'         => __( 'Sticky', 'snow-monkey' ),
			'sticky-overlay' => __( 'Overlay (Sticky)', 'snow-monkey' ),
			'overlay'        => __( 'Overlay', 'snow-monkey' ),
			''               => __( 'Normal', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'layout' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-position' );
$control->join( $section )->join( $panel );
