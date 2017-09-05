<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'advertisement', [
	'title' => __( 'Advertisement', 'snow-monkey' ),
] );

$customizer->control( 'textarea', 'mwt-google-adsense', [
	'label'       => __( 'Google Adsense', 'snow-monkey' ),
	'description' => __( 'When pasting the code of the responsive ad unit, the advertisement is displayed in the prescribed part of the theme.', 'snow-monkey' ),
	'type'        => 'option',
] );

$section = $customizer->get_section( 'advertisement' );
$control = $customizer->get_control( 'mwt-google-adsense' );
$control->join( $section );
