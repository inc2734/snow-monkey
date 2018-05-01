<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'page-speed-optimization' );

$customizer->control( 'checkbox', 'output-head-style', [
	'label'    => __( 'Output CSS in head', 'snow-monkey' ),
	'priority' => 130,
	'default'  => false,
] );

$control = $customizer->get_control( 'output-head-style' );
$control->join( $section );
