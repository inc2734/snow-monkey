<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 *
 * renamed: app/customizer/seo-sns/sections/seo-meta/section.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'seo-meta',
	array(
		'title'    => __( 'Meta', 'snow-monkey' ),
		'priority' => 190,
	)
);
