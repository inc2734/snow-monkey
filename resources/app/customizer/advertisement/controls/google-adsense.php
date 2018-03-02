<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'advertisement' );

$customizer->control( 'textarea', 'mwt-google-adsense', [
	'label'       => __( 'Google Adsense', 'snow-monkey' ),
	'description' => __( 'When pasting the code of the responsive ad unit or auto ads code, the advertisement is displayed in the prescribed part of the theme. If you want to display at arbitrary position, please use widgets etc.', 'snow-monkey' ),
	'type'        => 'option',
] );

$control = $customizer->get_control( 'mwt-google-adsense' );
$control->join( $section );
