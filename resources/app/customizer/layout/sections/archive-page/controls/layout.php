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
	'archive-page-layout',
	[
		'label'   => __( 'Page layout', 'snow-monkey' ),
		'default' => 'one-column',
		'choices' => Helper::get_page_templates(),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'layout' );
$section = Framework::get_section( 'archive-page' );
$control = Framework::get_control( 'archive-page-layout' );
$control->join( $section )->join( $panel );
