<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'checkbox',
	'mwt-display-related-posts',
	[
		'label'    => __( 'Display related posts in posts', 'snow-monkey' ),
		'priority' => 130,
		'type'     => 'option',
		'default'  => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-post' );
$control = Framework::get_control( 'mwt-display-related-posts' );
$control->join( $section )->join( $panel );
