<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 28.0.6
 *
 * renamed: app/customizer/seo-sns/sections/twitter-cards/section.php
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'twitter-cards',
	array(
		'title'    => __( 'Twitter Cards', 'snow-monkey' ),
		'priority' => 150,
	)
);
