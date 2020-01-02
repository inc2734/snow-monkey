<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'header-position-lg',
	[
		'label'    => __( 'Header position for PC', 'snow-monkey' ),
		'priority' => 111,
		'default'  => '',
		'choices'  => [
			'sticky'                 => __( 'Sticky', 'snow-monkey' ),
			'sticky-overlay'         => __( 'Overlay (Sticky)', 'snow-monkey' ),
			'sticky-overlay-colored' => __( 'Overlay (Sticky / When scrolling, whilte background)', 'snow-monkey' ),
			'overlay'                => __( 'Overlay', 'snow-monkey' ),
			''                       => __( 'Normal', 'snow-monkey' ),
		],
		'sanitize_callback' => function( $value ) {
			$mods = get_theme_mods();
			$is_more_than_v9 = isset( $mods['header-position-lg'] ) && false !== $mods['header-position-lg'];
			if ( $is_more_than_v9 ) {
				return $value;
			}

			// Backward compatibility
			$less_than_v9 = isset( $mods['header-position-only-mobile'] );
			if ( $less_than_v9 ) {
				remove_theme_mod( 'header-position-only-mobile' );
				return '';
			} else {
				$header_position = $mods['header-position'];
				if ( 'sticky-overlay' === $header_position && ! empty( $mods['scrolling-header-colored'] ) ) {
					remove_theme_mod( 'scrolling-header-colored' );
					return 'sticky-overlay-colored';
				}
				return $header_position;
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
$control = Framework::get_control( 'header-position-lg' );
$control->join( $section )->join( $panel );
