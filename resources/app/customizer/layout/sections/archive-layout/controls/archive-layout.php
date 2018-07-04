<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'layout' );
$section    = $customizer->get_section( 'archive-layout' );

$customizer->control( 'select', 'archive-layout', [
	'label'    => __( 'Archive layout', 'snow-monkey' ),
	'default'  => 'rich-media',
	'choices'  => [
		'rich-media' => __( 'Rich media', 'snow-monkey' ),
		'simple'     => __( 'Simple', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'archive-layout' );
$control->join( $section )->join( $panel );
