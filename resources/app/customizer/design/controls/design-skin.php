<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$choices = apply_filters( 'snow_monkey_design_skin_choices', [
	'none' => __( 'None', 'snow-monkey' ),
] );

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'design' );

$customizer->control( 'select', 'design-skin', [
	'label'       => __( 'Design skin', 'snow-monkey' ),
	'description' => __( 'If set this, please save and reload.', 'snow-monkey' ),
	'priority'    => 180,
	'default'     => 'none',
	'choices'     => $choices,
] );

$control = $customizer->get_control( 'design-skin' );
$control->join( $section );
