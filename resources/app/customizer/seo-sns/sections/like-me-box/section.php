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
	'like-me-box',
	[
		'title'    => __( 'Like me box', 'snow-monkey' ),
		'priority' => 170,
	]
);
