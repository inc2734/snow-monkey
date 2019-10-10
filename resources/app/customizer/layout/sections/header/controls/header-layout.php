<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'header-layout',
	[
		'transport' => 'postMessage',
		'label'     => __( 'Header layout', 'snow-monkey' ),
		'priority'  => 100,
		'default'   => 'center',
		'choices'  => is_customize_preview() ? Helper::get_header_templates() : [],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'layout' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-layout' );
$control->join( $section )->join( $panel );
$control->partial(
	[
		'selector'        => '.l-header',
		'render_callback' => function() {
			Helper::get_template_part( 'template-parts/header/' . get_theme_mod( 'header-layout' ) );
		},
	]
);
