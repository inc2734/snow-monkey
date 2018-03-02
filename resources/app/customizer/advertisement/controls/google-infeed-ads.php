<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'advertisement' );

$customizer->control( 'textarea', 'mwt-google-infeed-ads', [
	'label'       => __( 'Google Infeed Ads', 'snow-monkey' ),
	'description' => __( 'When pasting the code of the infeed ads, the advertisement is displayed in posts list.', 'snow-monkey' ),
	'type'        => 'option',
	'priority'    => 110,
] );

$control = $customizer->get_control( 'mwt-google-infeed-ads' );
$control->join( $section );
