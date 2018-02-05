<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'design' );

$customizer->control( 'number', 'base-font-size', [
	'label'    => __( 'Base font size(px)', 'snow-monkey' ),
	'default'  => 16,
	'priority' => 110,
] );

$control = $customizer->get_control( 'base-font-size' );
$control->join( $section );
