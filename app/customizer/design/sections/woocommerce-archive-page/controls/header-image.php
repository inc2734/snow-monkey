<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.3
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'image',
	'woocommerce-archive-header-image',
	[
		'label'    => __( 'Featured Image', 'snow-monkey' ),
		'priority' => 110,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-woocommerce-archive-page' );
$control = Framework::get_control( 'woocommerce-archive-header-image' );
$control->join( $section )->join( $panel );
