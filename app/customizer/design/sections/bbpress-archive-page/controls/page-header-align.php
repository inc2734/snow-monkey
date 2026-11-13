<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'bbpress-archive-page-header-align',
	array(
		'default'          => 'center',
		'ui_args_callback' => function () {
			return array(
				'label'           => __( 'Page header alignment', 'snow-monkey' ),
				'priority'        => 121,
				'choices'         => Helper::page_header_align_choices(),
				'active_callback' => function () {
					return 'title-on-page-header' === get_theme_mod( 'bbpress-archive-eyecatch' );
				},
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-bbpress-archive-page' );
$control = Framework::get_control( 'bbpress-archive-page-header-align' );
$control->join( $section )->join( $panel );
