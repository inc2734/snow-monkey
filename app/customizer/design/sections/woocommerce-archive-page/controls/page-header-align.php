<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'woocommerce-archive-page-header-align',
	[
		'label'           => __( 'Page header alignment', 'snow-monkey' ),
		'priority'        => 121,
		'default'         => 'center',
		'choices'         => Helper::page_header_align_choices(),
		'active_callback' => function() {
			return 'title-on-page-header' === get_theme_mod( 'woocommerce-archive-eyecatch' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-woocommerce-archive-page' );
$control = Framework::get_control( 'woocommerce-archive-page-header-align' );
$control->join( $section )->join( $panel );
