<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/google-analytics/section.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'google-analytics',
	array(
		'title'    => __( 'Google Analytics', 'snow-monkey' ),
		'priority' => 100,
	)
);
