<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'design-skin',
	array(
		'label'       => __( 'Design skin', 'snow-monkey' ),
		'description' => __( 'If set this, please save and reload.', 'snow-monkey' ),
		'default'     => 'none',
		'choices'     => apply_filters(
			'snow_monkey_design_skin_choices',
			array(
				'none' => __( 'None', 'snow-monkey' ),
			)
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'design-skin' );
$control = Framework::get_control( 'design-skin' );
$control->join( $section );
