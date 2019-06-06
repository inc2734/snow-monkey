<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'woocommerce-single-layout',
	[
		'label'    => __( 'Page layout', 'snow-monkey' ),
		'priority' => 100,
		'default'  => 'right-sidebar',
		'choices'  => Helper::get_page_templates(),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'layout' );
$section = Framework::get_section( 'woocommerce-single' );
$control = Framework::get_control( 'woocommerce-single-layout' );
$control->join( $section )->join( $panel );
