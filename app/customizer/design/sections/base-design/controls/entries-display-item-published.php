<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'post-entries-layout-display-item-published',
	array(
		'label'    => __( 'Display the published date for each item in the entries', 'snow-monkey' ),
		'priority' => 182,
		'default'  => true,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'post-entries-layout-display-item-published' );
$control->join( $section )->join( $panel );
