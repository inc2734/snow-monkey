<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'layout' );
$section    = $customizer->get_section( 'singular-post' );

$customizer->control( 'select', 'singular-post-layout', [
	'label'    => __( 'Page layout', 'snow-monkey' ),
	'priority' => 100,
	'default'  => 'right-sidebar',
	'choices'  => snow_monkey_get_page_templates(),
] );

$control = $customizer->get_control( 'singular-post-layout' );
$control->join( $section )->join( $panel );
