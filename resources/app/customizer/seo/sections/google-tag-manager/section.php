<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/google-tag-manager/section.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'google-tag-manager',
	array(
		'title'    => __( 'Google Tag Manager', 'snow-monkey' ),
		'priority' => 120,
	)
);
