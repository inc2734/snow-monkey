<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'layout' );
$section    = $customizer->get_section( 'archive-page' );

$customizer->control( 'select', 'archive-page-layout', [
	'label'   => __( 'Page layout', 'snow-monkey' ),
	'default' => 'one-column',
	'choices' => snow_monkey_get_page_templates(),
] );

$control = $customizer->get_control( 'archive-page-layout' );
$control->join( $section )->join( $panel );
