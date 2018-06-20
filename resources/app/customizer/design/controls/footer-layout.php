<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'design' );

$customizer->control( 'select', 'footer-widget-area-column-size', [
	'transport' => 'postMessage',
	'label'     => __( 'Number of columns in the footer widget area', 'snow-monkey' ),
	'priority'  => 170,
	'default'   => '1-4',
	'choices'   => [
		'1-1' => __( '1 column', 'snow-monkey' ),
		'1-2' => __( '2 columns', 'snow-monkey' ),
		'1-3' => __( '3 columns', 'snow-monkey' ),
		'1-4' => __( '4 columns', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'footer-widget-area-column-size' );
$control->join( $section );
$control->partial( [
	'selector'            => '.l-footer-widget-area',
	'container_inclusive' => true,
	'render_callback'     => function() {
		get_template_part( 'template-parts/footer-widget-area' );
	},
] );
