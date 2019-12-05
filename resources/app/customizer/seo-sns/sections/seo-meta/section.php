<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.3.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'seo-meta',
	[
		'title'    => __( 'Meta', 'snow-monkey' ),
		'priority' => 190,
	]
);
