<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.3.0
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'drawer-nav',
	[
		'title'    => __( 'Drawer nav', 'snow-monkey' ),
		'priority' => 125,
	]
);
