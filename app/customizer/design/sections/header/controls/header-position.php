<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.10.0
 *
 * renamed: app/customizer/layout/sections/header/controls/header-position.php
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'select',
	'header-position',
	[
		'label'    => __( 'Header position for mobile', 'snow-monkey' ),
		'priority' => 110,
		'default'  => 'sticky',
		'choices'  => Helper::header_position_choices(),
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'header' );
$control = Framework::get_control( 'header-position' );
$control->join( $section )->join( $panel );
