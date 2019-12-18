<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'page-layout',
	[
		'label'    => __( 'Page layout', 'snow-monkey' ),
		'priority' => 100,
		'default'  => '',
		'choices'  => is_customize_preview() ? array_merge( [ '' => __( 'Same as the post page layout', 'snow-monkey' ) ], Helper::get_wrapper_templates() ) : [],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-page' );
$control = Framework::get_control( 'page-layout' );
$control->join( $section )->join( $panel );
