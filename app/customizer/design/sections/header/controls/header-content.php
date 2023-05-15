<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 *
 * renamed: app/customizer/layout/sections/header/controls/header-content.php
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'textarea',
	'header-content',
	array(
		'label'       => __( 'Header contents', 'snow-monkey' ),
		'description' => __( 'Displayed at only PC size.', 'snow-monkey' ),
		'priority'    => 130,
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-content' );
$control->join( $section )->join( $panel );
