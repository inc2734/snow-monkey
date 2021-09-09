<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.7.0
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'bbpress-single-page-header-align',
	[
		'label'           => __( 'Page header alignment', 'snow-monkey' ),
		'priority'        => 111,
		'default'         => 'center',
		'choices'         => Helper::page_header_align_choices(),
		'active_callback' => function() {
			return 'title-on-page-header' === get_theme_mod( 'bbpress-single-eyecatch' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-bbpress-single' );
$control = Framework::get_control( 'bbpress-single-page-header-align' );
$control->join( $section )->join( $panel );
