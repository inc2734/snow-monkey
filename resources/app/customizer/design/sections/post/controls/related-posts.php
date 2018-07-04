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

$customizer->control( 'checkbox', 'mwt-display-related-posts', [
	'transport' => 'postMessage',
	'label'     => __( 'Display related posts in posts', 'snow-monkey' ),
	'priority'  => 130,
	'type'      => 'option',
	'default'   => true,
] );

$control = $customizer->get_control( 'mwt-display-related-posts' );
$control->join( $section )->join( $panel );
$control->partial( [
	'selector'            => '.p-related-posts',
	'container_inclusive' => true,
	'render_callback'     => function() {
		if ( get_option( 'mwt-display-related-posts' ) ) {
			get_template_part( 'template-parts/related-posts' );
		}
	},
] );
