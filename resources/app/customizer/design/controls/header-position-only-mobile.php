<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'design' );

$customizer->control( 'checkbox', 'header-position-only-mobile', [
	'label'    => __( 'Use header position setting for mobile only', 'snow-monkey' ),
	'priority' => 130,
	'default'  => true,
] );

$control = $customizer->get_control( 'header-position-only-mobile' );
$control->join( $section );
