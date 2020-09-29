<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'page-page-header-align',
	[
		'label'           => __( 'Page header alignment', 'snow-monkey' ),
		'priority'        => 111,
		'default'         => 'center',
		'choices'         => Helper::page_header_align_choices(),
		'active_callback' => function() {
			return 'title-on-page-header' === get_theme_mod( 'page-eyecatch' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-page' );
$control = Framework::get_control( 'page-page-header-align' );
$control->join( $section )->join( $panel );
