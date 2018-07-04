<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();
$panel      = $customizer->get_panel( 'design' );
$section    = $customizer->get_section( 'post' );

$customizer->control( 'checkbox', 'mwt-display-profile-box', [
	'transport' => 'postMessage',
	'label'     => __( 'Display profile box in posts', 'snow-monkey' ),
	'priority'  => 120,
	'type'      => 'option',
	'default'   => true,
] );

$control = $customizer->get_control( 'mwt-display-profile-box' );
$control->join( $section )->join( $panel );
$control->partial( [
	'selector'            => '.wp-profile-box',
	'container_inclusive' => true,
	'render_callback'     => function() {
		if ( get_option( 'mwt-display-profile-box' ) ) {
			get_template_part( 'template-parts/profile-box' );
		}
	},
] );
