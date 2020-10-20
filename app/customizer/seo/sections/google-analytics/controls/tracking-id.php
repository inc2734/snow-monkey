<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.7.0
 *
 * renamed: app/customizer/seo-sns/sections/google-analytics/controls/tracking-id.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'mwt-google-analytics-tracking-id',
	array(
		'label'       => __( 'Tracking ID', 'snow-monkey' ),
		'description' => __( 'e.g. UA-1111111-11 or G-XXXXXXXX', 'snow-monkey' ),
		'type'        => 'option',
		'priority'    => 100,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'google-analytics' );
$control = Framework::get_control( 'mwt-google-analytics-tracking-id' );
$control->join( $section )->join( $panel );
