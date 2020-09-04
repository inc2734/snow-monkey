<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.0
 *
 * renamed: app/customizer/layout/sections/base-layout/controls/breadcrumbs-position.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'breadcrumbs-position',
	[
		'label'    => __( 'Breadcrumbs display position', 'snow-monkey' ),
		'priority' => 170,
		'default'  => 'default',
		'choices'  => [
			'default'              => __( 'Top of contents', 'snow-monkey' ),
			'content-width'        => __( 'Top of contents ( Fit to content width )', 'snow-monkey' ),
			'bottom'               => __( 'Bottom of contents', 'snow-monkey' ),
			'bottom-content-width' => __( 'Bottom of contents ( Fit to content width )', 'snow-monkey' ),
			'none'                 => __( 'None', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'breadcrumbs-position' );
$control->join( $section )->join( $panel );
$control->partial(
	[
		'selector' => '.c-breadcrumbs',
	]
);
