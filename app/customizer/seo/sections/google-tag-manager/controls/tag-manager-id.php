<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 *
 * renamed: app/customizer/seo-sns/sections/google-tag-manager/controls/for-manager-in.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'text',
	'mwt-google-tag-manager-id',
	array(
		'label'       => __( 'Tag Manager ID', 'snow-monkey' ),
		'description' => __( 'e.g. GTM-X11X1XX', 'snow-monkey' ),
		'type'        => 'option',
		'priority'    => 100,
	)
);

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'google-tag-manager' );
$control = Framework::get_control( 'mwt-google-tag-manager-id' );
$control->join( $section )->join( $panel );
