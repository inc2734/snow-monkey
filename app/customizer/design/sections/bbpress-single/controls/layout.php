<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'bbpress-single-layout',
	array(
		'label'    => __( 'bbPress single page layout', 'snow-monkey' ),
		'priority' => 100,
		'default'  => '',
		'choices'  => is_customize_preview()
			? array_merge(
				array(
					'' => __( 'Same as the page layout', 'snow-monkey' ),
				),
				Helper::get_wrapper_templates()
			)
			: array(),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-bbpress-single' );
$control = Framework::get_control( 'bbpress-single-layout' );
$control->join( $section )->join( $panel );
