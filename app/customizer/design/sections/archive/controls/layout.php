<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.0
 *
 * renamed: app/customizer/layout/sections/archive-page/controls/layout.php
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'archive-post-layout',
	[
		'label'       => __( 'Page layout', 'snow-monkey' ),
		'description' => sprintf(
			/* translators: 1: archive */
			__( 'Select page layout for %1$s page.', 'snow-monkey' ),
			__( 'archive', 'snow-monkey' )
		),
		'default'     => 'one-column',
		'choices'     => is_customize_preview() ? Helper::get_wrapper_templates() : [],
		'priority'    => 100,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-archive' );
$control = Framework::get_control( 'archive-post-layout' );
$control->join( $section )->join( $panel );
