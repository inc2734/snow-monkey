<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'design' );

$customizer->control( 'image', 'default-page-header-image', [
	'label'       => __( 'Display page header image', 'snow-monkey' ),
	'description' => __( 'When set, the page header is displayed on all pages (except the homepage).', 'snow-monkey' ),
	'priority'    => 123,
] );

$control = $customizer->get_control( 'default-page-header-image' );
$control->join( $section );
