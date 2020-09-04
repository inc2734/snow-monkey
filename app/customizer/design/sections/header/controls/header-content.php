<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/layout/sections/header/controls/header-content.php
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'textarea',
	'header-content',
	[
		'label'       => __( 'Header contents', 'snow-monkey' ),
		'description' => __( 'Displayed at only PC size.', 'snow-monkey' ),
		'priority'    => 130,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-content' );
$control->join( $section )->join( $panel );
