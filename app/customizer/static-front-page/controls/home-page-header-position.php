<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.10.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'home-page-header-position',
	[
		'label'    => __( 'Overwrite header position for mobile', 'snow-monkey' ),
		'priority' => 140,
		'default'  => 'inherit',
		'choices'  => array_merge(
			[
				'inherit' => __( 'Do not overwrite', 'snow-monkey' ),
			],
			Helper::header_position_choices()
		),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'static_front_page' );
$control = Framework::get_control( 'home-page-header-position' );
$control->join( $section );
