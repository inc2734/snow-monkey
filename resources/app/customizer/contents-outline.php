<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'contents-outline', [
	'title' => __( 'Contents outline of posts', 'snow-monkey' ),
] );

$customizer->control( 'checkbox', 'mwt-display-contents-outline', [
	'label' => __( 'Display contents outline', 'snow-monkey' ),
	'type'  => 'option',
] );

$section = $customizer->get_section( 'contents-outline' );
$control = $customizer->get_control( 'mwt-display-contents-outline' );
$control->join( $section );
