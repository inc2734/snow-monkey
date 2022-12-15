<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'design-post',
	array(
		'title'           => __( 'Posts settings', 'snow-monkey' ),
		'priority'        => 130,
		'active_callback' => function() {
			return is_singular( 'post' );
		},
	)
);
