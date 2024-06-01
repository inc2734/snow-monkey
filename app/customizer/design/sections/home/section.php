<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'design-home',
	array(
		'title'           => __( 'Posts page settings', 'snow-monkey' ),
		'priority'        => 140,
		'active_callback' => function () {
			return is_home();
		},
	)
);
