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
	'footer-layout',
	array(
		'label'    => __( 'Footer layout', 'snow-monkey' ),
		'priority' => 100,
		'default'  => 'footer',
		'choices'  => is_customize_preview() ? Helper::get_footer_templates() : array(),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'footer' );
$control = Framework::get_control( 'footer-layout' );
$control->join( $section )->join( $panel );
