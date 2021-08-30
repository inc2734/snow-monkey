<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.6.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'snow-monkey-forms-btn',
	[
		'label'    => __( 'Use accent colors for buttons.', 'snow-monkey' ),
		'priority' => 100,
		'default'  => false,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$section = Framework::get_section( 'snow-monkey-forms' );
$control = Framework::get_control( 'snow-monkey-forms-btn' );
$control->join( $section );
