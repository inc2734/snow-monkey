<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'seo-sns' );

$customizer->section( 'share-buttons', [
	'title'       => __( 'Share buttons', 'snow-monkey' ),
	'priority'    => 160,
	'description' => sprintf(
		__( 'If you want to count of tweet then needs to register to %1$s.', 'snow-monkey' ),
		'<a href="https://opensharecount.com/" target="_blank">OpenShareCount</a>'
	),
] );
