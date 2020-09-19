<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'mwt-protected-more',
	[
		'label'    => __( 'If the post using more tag and password protect at the same time, display contents before more tag', 'snow-monkey' ),
		'priority' => 240,
		'type'     => 'option',
		'default'  => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'base-design' );
$control = Framework::get_control( 'mwt-protected-more' );
$control->join( $section )->join( $panel );
