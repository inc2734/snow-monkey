<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->control(
	'checkbox',
	'mwt-protected-more',
	[
		'label'     => __( 'If the post using more tag and password protect at the same time, display contents before more tag', 'snow-monkey' ),
		'priority'  => 160,
		'type'      => 'option',
		'default'   => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = $customizer->get_panel( 'design' );
$section = $customizer->get_section( 'base-design' );
$control = $customizer->get_control( 'mwt-protected-more' );
$control->join( $section )->join( $panel );
