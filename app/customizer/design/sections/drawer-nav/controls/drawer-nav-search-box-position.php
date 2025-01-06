<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.5.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'drawer-nav-search-box-position',
	array(
		'label'           => __( 'Search box position', 'snow-monkey' ),
		'priority'        => 150,
		'default'         => 'bottom',
		'choices'         => array(
			'top'    => __( 'Top', 'snow-monkey' ),
			'bottom' => __( 'Bottom', 'snow-monkey' ),
		),
		'active_callback' => function () {
			return get_theme_mod( 'display-drawer-nav-search-box' );
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'drawer-nav' );
$control = Framework::get_control( 'drawer-nav-search-box-position' );
$control->join( $section )->join( $panel );
