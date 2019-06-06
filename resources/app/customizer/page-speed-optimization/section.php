<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'page-speed-optimization',
	[
		'title'       => __( 'Page speed optimization', 'snow-monkey' ),
		'description' => __( 'This feature is a beta version.', 'snow-monkey' ),
		'priority'    => 1070,
	]
);
