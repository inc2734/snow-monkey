<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/seo-meta/controls/auto-description.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'mwt-auto-description',
	[
		'label'    => __( 'Automatically output meta description', 'snow-monkey' ),
		'type'     => 'option',
		'priority' => 100,
		'default'  => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'seo-meta' );
$control = Framework::get_control( 'mwt-auto-description' );
$control->join( $section )->join( $panel );
