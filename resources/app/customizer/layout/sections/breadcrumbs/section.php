<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'layout' );

$customizer->section( 'breadcrumbs', [
	'title'    => __( 'Breadcrumbs', 'snow-monkey' ),
	'priority' => 140,
] );
