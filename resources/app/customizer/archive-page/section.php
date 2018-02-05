<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->section( 'archive-page', [
	'title'           => __( 'Archive page settings', 'snow-monkey' ),
	'description'     => __( 'Applies to archive page and search page.', 'snow-monkey' ),
	'priority'        => 1110,
	'active_callback' => function() {
		return ( is_home() || is_archive() || is_search() || is_post_type_archive() );
	},
] );
