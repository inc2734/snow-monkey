<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.7.4
 *
 * renamed: app/customizer/layout/sections/header/controls/header-position.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'header-position',
	[
		'label'    => __( 'Header position for mobile', 'snow-monkey' ),
		'priority' => 110,
		'default'  => 'sticky',
		'choices'  => [
			'sticky'                 => __( 'Sticky', 'snow-monkey' ),
			'sticky-overlay'         => __( 'Overlay (Sticky)', 'snow-monkey' ),
			'sticky-overlay-colored' => __( 'Overlay (Sticky / When scrolling, whilte background)', 'snow-monkey' ),
			'overlay'                => __( 'Overlay', 'snow-monkey' ),
			''                       => __( 'Normal', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-position' );
$control->join( $section )->join( $panel );
