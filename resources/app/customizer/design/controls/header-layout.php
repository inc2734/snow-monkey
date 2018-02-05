<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'design' );

$customizer->control( 'select', 'header-layout', [
	'transport' => 'postMessage',
	'label'     => __( 'Header layout', 'snow-monkey' ),
	'priority'  => 120,
	'default'   => 'center',
	'choices'   => [
		'simple' => __( 'Simple', 'snow-monkey' ),
		'1row'   => __( 'One row', 'snow-monkey' ),
		'2row'   => __( 'Two rows', 'snow-monkey' ),
		'center' => __( 'Center logo', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'header-layout' );
$control->join( $section );
$control->partial( [
	'selector'        => '.l-header',
	'render_callback' => function() {
		get_template_part( 'template-parts/' . get_theme_mod( 'header-layout' ) . '-header' );
	},
] );
