<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
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
		'title'       => __( 'Twitter Cards', 'snow-monkey' ),
		'priority'    => 150,
		'description' => sprintf(
			/* translators: 1: Card validator link */
			__( 'Application of URL is necessary for using Twitter Cards. %1$s', 'snow-monkey' ),
			'<a href="https://cards-dev.twitter.com/validator" target="_blank" rel="noreferrer">Card validator</a>'
		),
	)
);
