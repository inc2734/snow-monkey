<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 *
 * renamed: app/customizer/layout/sections/base-layout/controls/container-max-width.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::control(
	'text',
	'container-max-width',
	array(
		'label'       => __( 'Container max width', 'snow-monkey' ),
		'description' => __( 'You can set the maximum width of the container.', 'snow-monkey' ) . __( 'Numeric values only are treated as px.', 'snow-monkey' ),
		'priority'    => 140,
	)
);

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'container-max-width' );
$control->join( $section )->join( $panel );
