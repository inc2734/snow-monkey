<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.1
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'entries',
	array(
		'title'       => __( 'Entries', 'snow-monkey' ),
		'description' => __( 'This is the setting for the entries section of "Posts".', 'snow-monkey' ),
		'priority'    => 130,
	)
);
