<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$section    = $customizer->get_section( 'singular-post' );

$customizer->control( 'checkbox', 'mwt-display-profile-box', [
	'transport' => 'postMessage',
	'label'     => __( 'Display profile box in posts', 'snow-monkey' ),
	'priority'  => 120,
	'type'      => 'option',
	'default'   => true,
	'active_callback' => function() {
		return is_singular( 'post' );
	},
] );

$control = $customizer->get_control( 'mwt-display-profile-box' );
$control->join( $section );
$control->partial( [
	'selector'            => '.wp-profile-box',
	'container_inclusive' => true,
	'render_callback'     => function() {
		get_template_part( 'template-parts/profile-box' );
	},
] );
