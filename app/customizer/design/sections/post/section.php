<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'design-post',
	[
		'title'           => __( 'Posts settings', 'snow-monkey' ),
		'priority'        => 130,
		'active_callback' => function() {
			return is_singular( 'post' );
		},
	]
);
