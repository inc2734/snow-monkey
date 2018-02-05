<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'seo-sns' );

$customizer->section( 'twitter-cards', array(
	'title'       => __( 'Twitter Cards', 'snow-monkey' ),
	'priority'    => 150,
	'description' => sprintf(
		__( 'Application of URL is necessary for using Twitter Cards. %1$s', 'snow-monkey' ),
		'<a href="https://cards-dev.twitter.com/validator" target="_blank">Card validator</a>'
	),
) );
