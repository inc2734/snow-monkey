<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

$font_family_settings = Helper::get_font_family_settings();
foreach ( $font_family_settings as $font_family => $font_family_setting ) {
	if ( ! isset( $font_family_setting['default'] ) || ! isset( $font_family_setting['variation'] ) ) {
		continue;
	}

	$choices = array();
	foreach ( $font_family_setting['variation'] as $weight => $variation ) {
		$choices[ $weight ] = $variation['label'];
	}
	ksort( $choices );

	Framework::control(
		'multiple-checkbox',
		$font_family . '-font-weight',
		array(
			'label'             => __( 'Font weight', 'snow-monkey' ),
			'default'           => $font_family_setting['default'],
			'priority'          => 121,
			'choices'           => $choices,
			'active_callback'   => function () use ( $font_family ) {
				return get_theme_mod( 'base-font' ) === $font_family;
			},
			'sanitize_callback' => function ( $value ) use ( $font_family_setting ) {
				return $value ? $value : $font_family_setting['default'];
			},
		)
	);

	if ( ! is_customize_preview() ) {
		continue;
	}

	$panel   = Framework::get_panel( 'design' );
	$section = Framework::get_section( 'base-design' );
	$control = Framework::get_control( $font_family . '-font-weight' );
	$control->join( $section )->join( $panel );
}
