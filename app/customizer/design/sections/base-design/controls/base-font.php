<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 17.2.3
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'base-font',
	[
		'label'       => __( 'Base font', 'snow-monkey' ),
		'description' => __( 'For all other options except "Sans serif" and "Serif", downloading of the font file will occur when selecting the option. Please wait a while as the download will take some time. The font files will be downloaded to wp-content/uploads/inc2734-wp-google-fonts.', 'snow-monkey' ),
		'priority'    => 120,
		'default'     => 'sans-serif',
		'choices'     => [
			'sans-serif'        => __( 'Sans serif', 'snow-monkey' ),
			'serif'             => __( 'Serif', 'snow-monkey' ),
			'noto-sans-jp'      => __( 'Noto Sans JP', 'snow-monkey' ),
			'noto-serif-jp'     => __( 'Noto Serif JP', 'snow-monkey' ),
			'm-plus-1p'         => __( 'M PLUS 1p', 'snow-monkey' ),
			'm-plus-rounded-1c' => __( 'M PLUS Rounded 1c', 'snow-monkey' ),
			'biz-udpgothic'     => __( 'BIZ UDPGothic', 'snow-monkey' ),
			'biz-udpmincho'     => __( 'BIZ UDPMincho', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'base-font' );
$control->join( $section )->join( $panel );
