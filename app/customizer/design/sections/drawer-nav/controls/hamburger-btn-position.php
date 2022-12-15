<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 *
 * renamed: app/customizer/design/sections/header/controls/hamburger-btn-position.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'hamburger-btn-position',
	array(
		'label'    => __( 'Hamberger button position', 'snow-monkey' ),
		'priority' => 100,
		'default'  => 'right',
		'choices'  => array(
			'left'  => __( 'Left', 'snow-monkey' ),
			'right' => __( 'Right', 'snow-monkey' ),
		),
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'drawer-nav' );
$control = Framework::get_control( 'hamburger-btn-position' );
$control->join( $section )->join( $panel );
