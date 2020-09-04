<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.3.6
 */

use Inc2734\WP_Customizer_Framework\Framework;
use Framework\Helper;

Framework::control(
	'checkbox',
	'mwt-display-profile-box',
	[
		'transport' => 'postMessage',
		'label'     => __( 'Display profile box in posts', 'snow-monkey' ),
		'priority'  => 120,
		'type'      => 'option',
		'default'   => true,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'design' );
$section = Framework::get_section( 'design-post' );
$control = Framework::get_control( 'mwt-display-profile-box' );
$control->join( $section )->join( $panel );
$control->partial(
	[
		'selector'            => '.wp-profile-box',
		'container_inclusive' => true,
		'render_callback'     => function() {
			if ( get_option( 'mwt-display-profile-box' ) ) {
				Helper::get_template_part( 'template-parts/common/profile-box' );
			}
		},
	]
);
