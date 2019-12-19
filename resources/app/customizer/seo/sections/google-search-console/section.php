<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: app/customizer/seo-sns/sections/google-search-console/section.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'google-search-console',
	array(
		'title'    => __( 'Google Search Console', 'snow-monkey' ),
		'priority' => 110,
	)
);
