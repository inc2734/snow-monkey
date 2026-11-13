<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 31.1.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'post-entries-display-item-modified',
	array(
		'default'          => false,
		'ui_args_callback' => function () {
			return array(
				'label'    => __( 'Display the modified date for each item in the entries', 'snow-monkey' ),
				'priority' => 140,
			);
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'entries' );
$control = Framework::get_control( 'post-entries-display-item-modified' );
$control->join( $section )->join( $panel );
