<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/layout/sections/header/controls/header-position.php
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
			'sticky'                 => __( 'Sticky', 'snow-monkey' ),
			'sticky-overlay'         => __( 'Overlay (Sticky)', 'snow-monkey' ),
			'sticky-overlay-colored' => __( 'Overlay (Sticky / When scrolling, whilte background)', 'snow-monkey' ),
			'overlay'                => __( 'Overlay', 'snow-monkey' ),
			''                       => __( 'Normal', 'snow-monkey' ),
		],
		'sanitize_callback' => function( $value ) {
			// Backward compatibility
			$mods = get_theme_mods();
			$header_position = $mods['header-position'];
			if ( 'sticky-overlay' === $header_position && ! empty( $mods['scrolling-header-colored'] ) ) {
				remove_theme_mod( 'scrolling-header-colored' );
				return 'sticky-overlay-colored';
			}

			return $value;
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-position' );
$control->join( $section )->join( $panel );
