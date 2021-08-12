<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.3.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'design-home',
	[
		'title'           => __( 'Posts page settings', 'snow-monkey' ),
		'priority'        => 130,
		'active_callback' => function() {
			return is_home();
		},
	]
);
