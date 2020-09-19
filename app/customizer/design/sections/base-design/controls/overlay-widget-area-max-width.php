<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 *
 * renamed: app/customizer/layout/sections/base-layout/controls/overlay-widget-area-max-width.php
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'overlay-widget-area-max-width',
	[
		'label'           => __( 'Overlay widget area max width', 'snow-monkey' ),
		'description'     => __( 'You can set max width of overlay widget area', 'snow-monkey' ),
		'priority'        => 190,
		'default'         => 'false',
		'choices'         => [
			'false' => __( 'Wide width', 'snow-monkey' ),
			'true'  => __( 'Slim width', 'snow-monkey' ),
		],
		'active_callback' => function() {
			return Helper::is_active_sidebar( 'overlay-widget-area' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'overlay-widget-area-max-width' );
$control->join( $section )->join( $panel );
