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
	'header-layout',
	[
		'transport' => 'postMessage',
		'label'     => __( 'Header layout', 'snow-monkey' ),
		'priority'  => 100,
		'default'   => 'center',
		'choices'   => [
			'simple' => __( 'Simple', 'snow-monkey' ),
			'1row'   => __( 'One row', 'snow-monkey' ),
			'2row'   => __( 'Two rows', 'snow-monkey' ),
			'center' => __( 'Center logo', 'snow-monkey' ),
		],
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
