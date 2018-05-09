<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'design' );

$customizer->control( 'checkbox', 'pure-css-gallery', [
	'label'    => __( 'Use Pure CSS Gallery', 'snow-monkey' ),
	'priority' => 180,
	'default'  => true,
] );

$control = $customizer->get_control( 'pure-css-gallery' );
$control->join( $section );
