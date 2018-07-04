<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'design' );
$section    = $customizer->get_section( 'base-design' );

$customizer->control( 'checkbox', 'pure-css-gallery', [
	'label'    => __( 'Use Pure CSS Gallery', 'snow-monkey' ),
	'priority' => 140,
	'default'  => true,
] );

$control = $customizer->get_control( 'pure-css-gallery' );
$control->join( $section )->join( $panel );
