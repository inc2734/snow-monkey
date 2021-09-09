<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.7.0
 */

use Framework\Helper;
use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'design-bbpress-archive-page',
	[
		'title'           => __( 'bbPress archive page settings', 'snow-monkey' ),
		'priority'        => 130,
		'active_callback' => function() {
			if ( ! class_exists( '\bbPress' ) ) {
				return false;
			}

			return Helper::is_bbpress_archive() || Helper::is_bbpress_mypage();
		},
	]
);
