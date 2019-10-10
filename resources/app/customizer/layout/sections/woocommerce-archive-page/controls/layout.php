<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'woocommerce-archive-page-layout',
	[
		'label'   => __( 'Page layout', 'snow-monkey' ),
		'default' => 'right-sidebar',
		'choices'  => is_customize_preview() ? Helper::get_wrapper_templates() : [],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'layout' );
$section = Framework::get_section( 'woocommerce-archive-page' );
$control = Framework::get_control( 'woocommerce-archive-page-layout' );
$control->join( $section )->join( $panel );
