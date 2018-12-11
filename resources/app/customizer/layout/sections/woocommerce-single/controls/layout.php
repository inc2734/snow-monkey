<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;
use Framework\Helper;

$customizer = Customizer_Framework::init();

$customizer->control(
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

$panel   = $customizer->get_panel( 'layout' );
$section = $customizer->get_section( 'woocommerce-single' );
$control = $customizer->get_control( 'woocommerce-single-layout' );
$control->join( $section )->join( $panel );
