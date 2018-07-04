<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'layout' );
$section    = $customizer->get_section( 'header' );

$customizer->control( 'select', 'header-position', [
	'label'    => __( 'Header position', 'snow-monkey' ),
	'priority' => 110,
	'default'  => 'sticky',
	'choices'  => [
		'sticky'  => __( 'Sticky', 'snow-monkey' ),
		'overlay' => __( 'Overlay', 'snow-monkey' ),
		''        => __( 'Normal', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'header-position' );
$control->join( $section )->join( $panel );
