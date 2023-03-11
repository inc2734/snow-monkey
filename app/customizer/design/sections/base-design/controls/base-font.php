<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.0.0
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

$font_family_settings = Helper::get_font_family_settings();
$choices              = array();
foreach ( $font_family_settings as $font_family => $font_family_setting ) {
	$choices[ $font_family ] = $font_family_setting['label'];
}

Framework::control(
	'select',
	'base-font',
	array(
		'label'    => __( 'Base font', 'snow-monkey' ),
		'priority' => 120,
		'default'  => 'sans-serif',
		'choices'  => $choices,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'base-font' );
$control->join( $section )->join( $panel );
