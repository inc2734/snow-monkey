<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'design-bbpress-single',
	array(
		'title'           => __( 'bbPress single page settings', 'snow-monkey' ),
		'priority'        => 140,
		'active_callback' => function () {
			if ( ! class_exists( '\bbPress' ) ) {
				return false;
			}

			return Helper::is_bbpress_single();
		},
	)
);
