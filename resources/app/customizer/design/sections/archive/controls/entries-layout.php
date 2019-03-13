<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'select',
	'post-entries-layout',
	[
		'label'    => __( 'Entries layout', 'snow-monkey' ),
		'priority' => 100,
		'default'  => 'rich-media',
		'choices'  => [
			'rich-media' => __( 'Rich media', 'snow-monkey' ),
			'simple'     => __( 'Simple', 'snow-monkey' ),
			'text'       => __( 'Text', 'snow-monkey' ),
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-archive' );
$control = Framework::get_control( 'post-entries-layout' );
$control->join( $section )->join( $panel );
