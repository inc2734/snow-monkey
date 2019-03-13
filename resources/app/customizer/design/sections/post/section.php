<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'post',
	[
		'title'           => __( 'Posts settings', 'snow-monkey' ),
		'description'     => __( 'By the type of page displayed on the preview screen on the right side of the screen, the display setting items switched.', 'snow-monkey' ) . __( 'Currently post settings is displayed.', 'snow-monkey' ),
		'priority'        => 110,
		'active_callback' => function() {
			return is_singular( 'post' );
		},
	]
);
