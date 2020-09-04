<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/structured-data/controls/json-ld.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'mwt-json-ld',
	array(
		'label'    => __( 'Output structred data (JSON+LD)', 'snow-monkey' ),
		'type'     => 'option',
		'priority' => 100,
		'default'  => true,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'seo' );
$section = Framework::get_section( 'json-ld' );
$control = Framework::get_control( 'mwt-json-ld' );
$control->join( $section )->join( $panel );
