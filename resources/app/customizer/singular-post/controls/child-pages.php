<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'singular-post' );

$customizer->control( 'checkbox', 'mwt-display-child-pages', [
	'transport' => 'postMessage',
	'label'     => __( 'Display child pages in page', 'snow-monkey' ),
	'priority'  => 140,
	'type'      => 'option',
	'default'   => true,
	'active_callback' => function() {
		$pages = get_children( [
			'post_parent'    => get_the_ID(),
			'post_type'      => get_post_type(),
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
		] );

		return ( $pages ) ? true : false;
	},
] );

$control = $customizer->get_control( 'mwt-display-child-pages' );
$control->join( $section );
$control->partial( [
	'selector'            => '.p-child-pages',
	'container_inclusive' => true,
	'render_callback'     => function() {
		return get_option( 'mwt-display-child-pages' );
	},
] );
